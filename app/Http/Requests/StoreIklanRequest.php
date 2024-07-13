<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIklanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'hari_kerja' => 'required',
            'provinsi' => 'sometimes|required',
            'kabupaten' => 'sometimes|required',
            'kecamatan' => 'sometimes|required',
            'desa' => 'sometimes|required',
            'alamat' => 'required',
            'gambar' => 'sometimes|required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
