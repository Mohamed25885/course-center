<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $dt = new \Carbon\Carbon();
        $before = $dt->subYears(6)->format('Y/m/d');
        return [
            "FirstName" => ["required", "string", "max:45"],
            "LastName" => ["required", "string", "max:45"],
            "Phone" => ["required", "numeric"],
            "BirthDate" => ["required", "date", 'before_or_equal:' . $before],
            "Email" => ["required", "email", "unique:students,Email"],

        ];
    }
}
