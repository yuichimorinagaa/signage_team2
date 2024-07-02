<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'file' => 'required|file|mimes:jpeg,jpg,png',
        ];
    }


    public function messages()
    {
        return [
            'file.required' => 'ファイルが選択されていません',
            'file.mimes' => '許可されたファイルタイプはjpeg,jpg,pngです',
        ];
    }
}
