<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && $this->input('user_id') == auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "user_id" => ["required", "exists:users,id"],
            "name" => ["required", "string", "max:45"],
            "email" => ["required", "email", "unique:users,email," . auth()->id() . ",id"],
            'image' => ['nullable', 'image'],
            'password' => ['nullable','confirmed',  Password::min(8)],
        ];
    }
}
