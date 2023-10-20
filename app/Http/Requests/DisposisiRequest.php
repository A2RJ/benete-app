<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DisposisiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tujuan' => 'required',
            'batas_waktu_tindaklanjuti' => 'required|date|after_or_equal:today',
            'jenis_disposisi' => 'required|in:Segera,Biasa',
            'status_disposisi' => 'required|in:Belum Ditindaklanjuti,Selesai,Ditolak',
            'catatan' => 'nullable|string'
        ];
    }
}
