<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            "CourseId" => ["required", "exists:courses,CourseId"],
            "CourseName" => ["required", "string", "max:45"],
            "CourseDescription" => ["required", "string", "max:45"],
            "Slug" => ["required", "string", "unique:courses,Slug," . $this->course->CourseId . ",CourseId"],

            'Image' => ['nullable', 'image'],

        ];
    }
}
