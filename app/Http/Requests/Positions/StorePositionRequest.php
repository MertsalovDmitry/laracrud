<?php

namespace App\Http\Requests\Positions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Rule;

class StorePositionRequest extends FormRequest
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
            // 'name' => 'required|min:2|max:256|unique:positions,name,' . $this->position, 
            'name' => 'required|min:2|max:256|unique:positions,name,' . $this->id, 
        ];
    }
}
