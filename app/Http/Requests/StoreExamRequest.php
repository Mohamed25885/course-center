<?php

namespace App\Http\Requests;

use App\Models\CourseCycles;
use Illuminate\Foundation\Http\FormRequest;

class StoreExamRequest extends FormRequest
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
        $dates = CourseCycles::where('CycleId', $this->input('CycleId'))->first(['StartDate', 'EndDate']);

        return [
            'CycleId' => ['required', 'exists:coursespercycle,CycleId'],
            'TestTime' => ['required',  'date_format:H:i'],
            'TestDate' => ['required',  'date', 'after_or_equal:' . $dates?->StartDate, 'before_or_equal:' . $dates?->EndDate],
            'TestDuration' => ['required', 'numeric'],
            'TestTitle' => ['required', 'string'],
            'MinGrade' => ['required', 'numeric'],
        ];
    }
}
