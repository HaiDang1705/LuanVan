<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAccountUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:db_qtvs,email',
            'password' => 'required|string|min:8|confirmed', // Kiểm tra mật khẩu xác nhận
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'password.required' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu không khớp.',
        ];
    }
}
