<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipientRequest extends FormRequest
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
            'nama' => 'required|min:3|max:100|string',
            'bd' => 'required|date|before:01/01/1996',
            'nik' => 'numeric|digits:16',
            'foto_penerima' => 'mimes:jpg,bmp,png,jpeg,svg,tiff,tif|image',
            'no_hp' => 'numeric',
            'jenkel' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'penyakit' => '',
            'rt' => 'numeric',
            'foto_ktp' => 'mimes:jpg,bmp,png,jpeg,svg,tiff,tif|image',
            'foto_kk' => 'mimes:jpg,bmp,png,jpeg,svg,tiff,tif|image',
            'foto_rumah' => 'mimes:jpg,bmp,png,jpeg,svg,tiff,tif|image',
            'status_rumah' => '',
            'long' => '',
            'lat' => ''
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'name.required' => 'Name is required!',
            'password.required' => 'Password is required!'
        ];
    }
}
