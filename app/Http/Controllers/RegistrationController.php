<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(StoreRegistrationRequest $request)
    {
        Registration::create($request->validated());

        return redirect()
            ->route('register')
            ->with('success', 'اطلاعات شما با موفقیت ثبت شد.');
    }
}
