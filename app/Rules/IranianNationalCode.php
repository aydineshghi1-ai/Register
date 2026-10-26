<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IranianNationalCode implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (! is_string($value) || ! preg_match('/^[0-9]{10}$/', $value)) {
            $fail('کد ملی باید دقیقاً ۱۰ رقم انگلیسی باشد.');
            return;
        }

        if (preg_match('/^([0-9])\1{9}$/', $value)) {
            $fail('کد ملی واردشده معتبر نیست.');
            return;
        }


        $sum = 0;

        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $value[$i] * (10 - $i);
        }


        $remainder = $sum % 11;
        $checkDigit = (int) $value[9];

        if ($remainder < 2) {
            $isValid = $checkDigit === $remainder;
        } else {
            $isValid = $checkDigit === (11 - $remainder);
        }

        if (! $isValid) {
            $fail('کد ملی واردشده معتبر نیست.');
        }
    }
}
