<?php

namespace App\Http\Requests;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'jk' => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ];

        if ($this->user()->staff) {
            // Jika user memiliki relasi Staff, tambahkan aturan validasi untuk kolom 'status'
            $rules['status'] = 'required';
        } else {
            // Jika user tidak memiliki relasi Staff, tambahkan aturan validasi untuk kolom 'kelas_id'
            $rules['kelas_id'] = 'required';
        }

        return $rules;
    }
}
