<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreviewRequest extends FormRequest
{
public function authorize()
{
return true;
}

public function rules()
{
return [
'selected_files' => 'required', // 必須であり、配列であることを要求
];
}

public function messages()
{
return [
'selected_files.required' => 'ファイルが選択されていません。'

];
}
}
