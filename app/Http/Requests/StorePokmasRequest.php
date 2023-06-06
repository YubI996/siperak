<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePokmasRequest extends FormRequest
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
            'nama' => 'required|string|max:30',
            'alamat' => 'required|string|max:255',
            'rt_id' => 'required|numeric',
            'ketua' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Lengkapi kolom nama',
            'alamat.required' => 'Lengkapi kolom alamat',
            'rt_id.required' => 'Lengkapi kolom RT',
            'ketua.required' => 'Lengkapi kolom ketua'
        ];
    }
}
