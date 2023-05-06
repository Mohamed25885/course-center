<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCycleClassRequest extends FormRequest
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
        //ClassNo, CycleId, ClassTitle, ClassDay, StartTime, EndTime

        return [
            'ClassTitle' => ['required', 'string', 'max:45'],
            'StartTime' => ['required',  'date_format:H:i'],
            'EndTime' => ['required',  'date_format:H:i', 'after:StartTime'],
            'ClassDay' => [
                'required', 'min:0', 'max:6',
                Rule::unique('classes', 'ClassDay')->where('CycleId', $this->courseCycles->CycleId)
            ]
        ];
    }
}
