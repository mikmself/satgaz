<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $this->id . '|max:255',
            'telephone' => 'nullable|string|unique:users,telephone,' . $this->id . '|max:255',
            'level' => 'required|in:Superadmin,Admin,User',
        ];
        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:8|max:255';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus dalam format yang benar.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'telephone.string' => 'Nomor telepon harus berupa string.',
            'telephone.unique' => 'Nomor telepon sudah digunakan oleh pengguna lain.',
            'telephone.max' => 'Nomor telepon tidak boleh lebih dari 255 karakter.',
            'level.required' => 'Level harus diisi.',
            'level.in' => 'Level yang dipilih tidak valid.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.max' => 'Password tidak boleh lebih dari 255 karakter.',
        ];
    }
}
