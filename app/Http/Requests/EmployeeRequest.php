<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'username' => 'required|unique:users,username',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'village_id' => 'required',
            'no_telp' => 'required|integer',
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
            'username.required' => 'Username Wajib Diisi',
            'username.unique' => 'Username Sudah Terdaftar',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Email Tidak Valid',
            'email.unique' => 'Email Sudah Terdaftar',
            'password.required' => 'Pasword Wajib Diisi',
            'password.min' => 'Password Wajib Diisi Dalam 8 Karakter',
            'image.required' => 'Foto Wajib Diisi',
            'village_id.required' => 'Kelurahan Wajib Diisi',
            'no_telp.required' => 'No Whatsapp Wajib Diisi',
            'no_telp.integer' => 'No Whatsapp Tidak Valid',
        ];
    }
}
