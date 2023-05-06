<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExamResultRequest extends FormRequest
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
            /* 'StudentId' => [
                'required', 'exists:students,StudentId',
                $this->result->TestNo == $this->input('TestNo') && $this->result->StudentId == $this->input('StudentId') ? '' :
                    Rule::unique('examsgrades', 'StudentId')->where('TestNo', $this->input('TestNo'))
            ],
            'TestNo' => ['required', 'exists:exams,TestNo'], */
            'Grade' => ['required', 'numeric']
        ];
    }
}
