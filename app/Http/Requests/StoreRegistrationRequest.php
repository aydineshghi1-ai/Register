<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],

            'mobile' => ['required', 'string','min:11', 'max:20', 'unique:registrations,mobile'],

            'email' => ['required', 'email', 'max:255', 'unique:registrations,email'],

            'birth_date' => ['required', 'date', 'before:today'],

            'national_id' => ['required', 'digits:10', 'unique:registrations,national_id'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'وارد کردن نام الزامی است.',
            'last_name.required' => 'وارد کردن نام خانوادگی الزامی است.',

            'mobile.required' => 'وارد کردن شماره موبایل الزامی است.',
            'mobile.unique' => 'این شماره موبایل قبلاً ثبت شده است.',
            'mobile.min' => 'شماره تماس شما باید بیش از 11 رقم باشد.',

            'email.required' => 'وارد کردن ایمیل الزامی است.',
            'email.email' => 'فرمت ایمیل معتبر نیست.',
            'email.unique' => 'این ایمیل قبلاً ثبت شده است.',

            'birth_date.required' => 'وارد کردن تاریخ تولد الزامی است.',
            'birth_date.date' => 'تاریخ تولد معتبر نیست.',
            'birth_date.before' => 'تاریخ تولد باید قبل از امروز باشد.',

            'national_id.required' => 'وارد کردن کد ملی الزامی است.',
            'national_id.digits' => 'کد ملی باید دقیقاً ۱۰ رقم باشد.',
            'national_id.unique' => 'این کد ملی قبلاً ثبت شده است.',
        ];
    }
}
