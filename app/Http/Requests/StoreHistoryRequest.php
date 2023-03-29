<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'recipient_id' => 'required|exists:recipients,id',
            'status_trima' => 'required|in:Diajukan,Menerima,Ditolak,Menolak,Pindah,Meninggal,Dihapus',
            'alasan' => 'nullable',
            'actor_id' => 'required|exists:users,id',
        ];
    }
}
