<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddColorRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'unique:lv_colorproduct,color_name'
        ];
    }
    public function messages()
    {
        return [
            'name.unique'=>'Tên màu đã bị trùng!'
        ];
    }
}
