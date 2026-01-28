<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'Vui lòng nhập email',
            'email.email'       => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ];
    }

    public function authenticate(): void
    {
        if (! Auth::attempt(
            $this->only('email', 'password'),
            $this->boolean('remember')
        )) {
            throw ValidationException::withMessages([
                'email' => 'Email hoặc mật khẩu không đúng',
            ]);
        }
    }
}
