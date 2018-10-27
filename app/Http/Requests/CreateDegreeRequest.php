<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDegreeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // University
            'IPED' => 'required|numeric',
            'institution-name' => 'required',
            'city' => 'required',
            'state' => 'required',
            'first-report' => 'digits:4',
            'website' => 'required|url',

            // Degree
            'degree-name' => 'required',
            'department-name' => 'required',
        ];
    }
}
