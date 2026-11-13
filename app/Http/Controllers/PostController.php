<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(
            auth()->user()->hasAllRoles(['reporter','admin'])||
                    auth()->user()->hasAllRoles(['reporter','creator']),
            403
        );

        $query = Post::query();

        if (auth()->user()->hasAllRoles(['reporter', 'admin'])) {
            //
        } else {

            $query->where('author_id', auth()->id());
        }

        $posts = $query->with([
            'author',
            'categories'
        ])->latest()->get();

        return view('posts.index', compact('posts'));
    }


    public function publicIndex()
    {
        $posts = Post::where('status', 'published')
            ->with(['author', 'categories'])
            ->latest('published_at')
            ->paginate(10);

        return view('posts.public-index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(
            auth()->user()->hasAllRoles(['reporter','admin'])||
                    auth()->user()->hasAllRoles(['reporter','creator']),
            403
        );

        $categories = Category::all();

        return view('posts.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(
            auth()->user()->hasAllRoles(['reporter','admin'])||
            auth()->user()->hasAllRoles(['reporter','creator']),
            403
        );

        $validated = $request->validate([
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['integer', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:200'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['required', 'string'],
            'status' => ['required', 'in:draft,published,archived'],
        ]);

        $categoryIds = Arr::pull($validated, 'category_ids', []);

        $slug = Str::slug($validated['title']);

        $originalSlug = $slug;
        $count = 1;

        while (Post::where('slug', $slug)->exists())
        {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $authorId = auth()->id();
        $validated['author_id'] = $authorId;

        $validated['slug'] = $slug;

        if ($validated['status'] == 'published') {
            $validated['published_at'] = now();
        } else {
            $validated['published_at'] = null;
        }

        $post = Post::create($validated);

        $post->categories()->sync($categoryIds);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {

        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->with(['author', 'categories'])
            ->firstOrFail();
        $categories = Category::orderBy('name')->get();

        return view('posts.show', compact('post', 'categories'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->firstOrFail();

        abort_unless(
            auth()->user()->hasAllRoles(['reporter','admin'])||
                    auth()->user()->hasAllRoles(['reporter','creator']),
            403
        );

        if ( auth()->user()->hasAllRoles(['reporter', 'creator']) )
        {
            abort_unless
            (
                $post->author_id === auth()->id(),
                403
            );
        }

        $categories = Category::all();

        $post->load('categories');

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $post = Post::where('slug', $slug)
            ->firstOrFail();
        abort_unless
        (
            auth()->user()->hasAllRoles(['reporter','admin'])||
                    auth()->user()->hasAllRoles(['reporter','creator']),
        403
        );

        if( auth()->user()->hasAllRoles(['reporter', 'creator']) )
        {
            abort_unless
            (
                $post->author_id === auth()->id(),
                403
            );
        }

        $validated = $request->validate
        (
            [
                'category_ids' => ['nullable', 'array'],
                'category_ids.*' => ['integer', 'exists:categories,id'],
                'title' => ['required', 'string', 'max:200'],
                'excerpt' => ['nullable', 'string'],
                'body' => ['nullable', 'string'],
                'status' => ['required', 'in:draft,published,archived'],
            ]

        );

        $categoryIds = Arr::pull($validated, 'category_ids', []);

        $slug = Str::slug($validated['title']);



        $originalSlug = $slug;
        $count = 1;

        $newSlug = Post::where('slug', $slug)
            ->where('id', '!=', $post->id)
            ->exists();

        while ($newSlug === true)
        {
            $slug = $originalSlug . '-' . $count;
            $count++;

            $newSlug = Post::where('slug', $slug)
                ->where('id', '!=', $post->id)
                ->exists();
        }


        if( $validated['status'] === 'published')
        {
            $validated['published_at'] = $post->published_at ?? now();
        }
        else
        {
            $validated['published_at'] = null;
        }

        $validated['slug'] = $slug;

        DB::transaction(function () use ($post, $validated, $categoryIds) {

            $post->update($validated);

            $post->categories()->sync($categoryIds);

        });

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->firstOrFail();

        abort_unless
        (
            auth()->user()->hasAllRoles(['reporter','admin'])||
            auth()->user()->hasAllRoles(['reporter','creator']),
            403
        );

        if( auth()->user()->hasAllRoles(['reporter', 'creator']) )
        {
            abort_unless
            (
                $post->author_id === auth()->id(),
                403
            );
        }

        $post->delete();
        return redirect()
            ->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
