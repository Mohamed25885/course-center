<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "FirstName" => ["required", "string", "max:45"],
            "LastName" => ["required", "string", "max:45"],
            "Phone" => ["required", "numeric"],
            "Email" => ["required", "email", "unique:teachers,Email"],
        ];
    }
}
