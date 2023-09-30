<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Judul harus diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.max' => 'Judul tidak boleh lebih dari :max karakter.',
            'content.required' => 'Konten harus diisi.',
            'content.string' => 'Konten harus berupa teks.',
        ];
    }
}
