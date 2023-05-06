<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCycleClassRequest extends FormRequest
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
            'ClassTitle' => ['required', 'string', 'max:45'],
            'StartTime' => ['required',  'date_format:H:i'],
            'EndTime' => ['required',  'date_format:H:i', 'after:StartTime'],
        ];
    }
}
