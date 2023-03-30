<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreHistoryRequest extends FormRequest
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
            'slug' => 'required',
            'status_trima' => 'required|in:Diajukan,Menerima,Ditolak,Menolak,Pindah,Meninggal,Dihapus',
            'alasan' => 'nullable',
            'actor' => 'required|exists:users,id',
        ];
    }

    protected function valfailed(Validator $validator)
    {
        return back()->with(['warning' => 'validasi gagal!']);
    }
}
