<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KontakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string|min:10',
            'website_hp' => 'nullable|max:0', // Honeypot spam trap
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'subjek.required' => 'Subjek pertanyaan wajib diisi.',
            'pesan.required' => 'Isi pesan wajib diisi.',
            'pesan.min' => 'Isi pesan minimal terdiri dari 10 karakter.',
            'website_hp.max' => 'Spam terdeteksi.',
        ];
    }
}
