<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name' => 'required|min:2|max:256',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required|size:12',
            'salary' => 'required|numeric|regex:/^\\d{1,3}\\.{1}\\d{3}$/i',
            'position_id' => 'required|exists:positions,id',
            'parent_id' => 'required|exists:employees,id',
            'employed_at' => 'required|date_format:"Y-m-d"',
            'photo' => 'required|image|mimes:jpeg,png|max:5120'
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
     *
    * @return array
    */
    public function messages()
    {
        return [
            'salary.regex'    => 'The salary format must be like 499.000',
            'parent_id.required'    => 'The head field is required',
            'photo.max' =>  'Photo must be less then 5 mb',
        ];
    }
}
