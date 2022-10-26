<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorereceptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama' => 'required|string',
            'nik' => 'required|numeric',
            'bd' => 'required|string',
            'jk' => 'required|string',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string',
            'penyakit' => 'required|string',
            'rt' => 'required|string',
            'hp' => 'required|numeric|min:9',
            'ft' => 'required|string',
            'ft_ktp' => 'required|string',
            'ft_kk' => 'required|string',
            'ft_rmh' => 'required|string',
            'tmpt' => 'required|string',
            'long' => 'required|numeric',
            'lat' => 'required|numeric',
        ];
    }
}
