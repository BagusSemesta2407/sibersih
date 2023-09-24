<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'nomor_induk' => 'required|unique:users,nomor_induk|integer',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];

        if ($this->_method != 'put') {
            $rules['image'] =   'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'nomor_induk.required' => 'Nomor Induk Wajib Diisi',
            'nomor_induk.unique' => 'Nomor Induk Sudah Terdaftar',
            'nomor_induk.integer' => 'Nomor Induk Tidak Valid',
            'name.required' => 'Nama Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Email Tidak Valid',
            'password.required' => 'Pasword Wajib Diisi',
            'password.min' => 'Password Wajib Diisi Dalam 8 Karakter',
            'image.required' => 'Foto Wajib Diisi'
        ];
    }
}
