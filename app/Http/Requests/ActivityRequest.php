<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
            'activity_category_id' => 'required',
            'date' => 'required',
            'name' => 'required',
            'address_details' => 'required',
            'describe_point_location' => 'required'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'activity_category_id.required' => 'Kategori Kegiatan Wajib Diisi',
            'name.required' => 'Nama Kegiatan Wajib Diisi',
            'date.required' => 'Waktu Kegiatan Wajib Diisi',
            'address_details.required' => 'Alamat Lengkap Wajib Diisi',
            'describe_point_location.required' => 'Deskripri Titik Lokasi Yang Perlu Dibersihkan Wajib Diisi'
        ];
    }
}
