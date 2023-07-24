<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
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
        return [
            'name' => 'required',
            'kode_member' => ['required', Rule::unique('members')->ignore($this->member)],
            'nis' => ['required', Rule::unique('members')->ignore($this->member)],
            'kelas_id' => 'required',
            'jk' => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($this->user)],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
    }
}