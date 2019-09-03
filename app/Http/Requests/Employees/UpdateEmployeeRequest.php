<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'name' => 'min:2|max:256',
            'email' => 'email:rfc,dns',
            'phone' => 'size:12',
            'salary' => 'numeric|regex:/^\\d{1,3}\\.{1}\\d{3}$/i',
            'position_id' => 'exists:positions,id',
            'parent_id' => 'exists:employees,id',
            'employed_at' => 'date_format:"Y-m-d"',
            'photo' => 'image|mimes:jpeg,png|max:5120'
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
            'photo.max' =>  'Photo must be less then 5 mb',
        ];
    }
}
