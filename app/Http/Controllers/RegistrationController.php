<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(StoreRegistrationRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        unset($data['password_confirmation']);


        Registration::create($data);

        return redirect()
            ->route('login')
            ->with('success', 'ثبت‌نام با موفقیت انجام شد. اکنون وارد حساب خود شوید.');
    }
}
