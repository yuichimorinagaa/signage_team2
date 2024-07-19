<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => ['required','email','unique:users', 'regex:/@social-db\.co\.jp$/'],
            'password' => ['required','min:8'],
            'invitation_code'=>['required','in:sdb-intern'],
        ];
    }

    public function messages()
    {
        return [
            'password.min'=>'パスワードは8文字以上で入力してください。',
            'email.unique'=>'このメールアドレスは既に登録されています。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email'=>'有効なメールアドレスを入力してください。',
            'email.regex'=>'有効なメールアドレスを使用してください',
            'password.required' => 'パスワードを入力してください。',
            'invitation_code.required'=>'招待コードを入力してください。',
            'invitation_code.in'=>'招待コードが正しくありません。'
        ];
    }
}
