<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTypeRequest extends FormRequest
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
            //
            'name'=>'unique:lv_typeproduct,type_name,'.$this->segment(4).',type_id'
        ];
    }

    public function messages()
    {
        return [
            'name.unique'=>'Tên loại sản phẩm đã bị trùng!'
        ];
    }
}
