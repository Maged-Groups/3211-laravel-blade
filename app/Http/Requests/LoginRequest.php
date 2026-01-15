<?php

namespace App\Http\Requests;

class LoginRequest extends BaseRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => ['required', 'min:8', 'max:16'],
        ];
    }


    /**
     * Get the validation messages that return with the response
     * 
     */

    public function messages(): array
    {
        return [
            'email.required' => 'لابد من كتابة البريد الإلكتروني',
            'email.email' => 'البريد المستخدم غير صحيح',
            'password.min' => 'كلمة المرور لا تقل عن 8 '
        ];
    }
}
