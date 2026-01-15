<?php

namespace App\Http\Requests;


class RegisterRequest extends BaseRequest
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
            "name" => 'required|between:3,15',
            "email" => 'required|email|unique:users,email',
            "password" => 'required|confirmed',
            "phone" => 'required|regex:/^01[0125]\d{8}$/|unique:users,phone',
            "profile_photo" => 'required|file|mimes:png,jpg|between:10,1024',
        ];
    }
}
