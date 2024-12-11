<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|min:3|max:100",
            "email" => "required|email",
            "phone" => "required|min:10|max:20",
            "start_date" => "required|date",
            "end_date" => "required|date",
            "avatar" => "nullable|mimes:jpg,jpeg,png|max:10000",
            "privacity" => "required|in:public,private",
        ];
    }
}
