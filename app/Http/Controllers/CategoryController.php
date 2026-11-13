<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = auth()->user()->categories;

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(auth()->user()->hasRole('creator'), 403);

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        abort_unless(auth()->user()->hasRole('creator'), 403);

        $validated = $request->validate([
           'name' => ['required', 'string', 'max:100'],
           'description' => ['nullable', 'string'],
        ]);

        $slug = Str::slug($validated['name']);

        $originalSlug = $slug;
        $count = 1;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $validated['slug'] = $slug;
        $validated['created_by'] = auth()->id();

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        abort_unless(
            auth()->user()->hasRole('creator') &&
            $category->created_by === auth()->id(),
            403
        );

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        abort_unless(
            auth()->user()->hasRole('creator') &&
            $category->created_by === auth()->id(),
            403
        );

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
        ]);

        $slug = Str::slug($validated['name']);

        $originalSlug = $slug;
        $count = 1;

        while (
        Category::where('slug', $slug)
            ->where('id', '!=', $category->id)
            ->exists()
        ) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        $validated['slug'] = $slug;

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully.');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        abort_unless(
            auth()->user()->hasRole('creator') &&
            $category->created_by === auth()->id(),
            403
        );

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');

    }
}
