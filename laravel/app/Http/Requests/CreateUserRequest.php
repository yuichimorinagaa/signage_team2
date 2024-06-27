<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
            'invitation_code'=>'required|in:sdb-intern',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスは必須です',
            'password.required' => 'パスワードは必須です',
            'invitation_code.required'=>'招待コードを入力してください。',
            'invitation_code.in'=>'招待コードが正しくありません。'
        ];
    }
}
