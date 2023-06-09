<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
        return [
            "CourseName" => ["required", "string", "max:45"],
            'Image' => ['nullable', 'image'],
            "Slug" => ["required", "string", "unique:courses,Slug"],

            "CourseDescription" => ["required", "string", "max:45"],

        ];
    }
}
