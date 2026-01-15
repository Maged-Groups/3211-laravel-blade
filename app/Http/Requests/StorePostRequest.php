<?php

namespace App\Http\Requests;



class StorePostRequest extends BaseRequest
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
            "post_title" => 'required',
            "post_body" => 'required',
            "thumbnail" => 'required',
            "post_status_id" => 'required',
        ];
    }
}
