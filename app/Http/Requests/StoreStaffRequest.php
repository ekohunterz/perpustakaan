<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStaffRequest extends FormRequest
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
            'nip' => ['required', Rule::unique('staff')->ignore($this->staff)],
            'jk' => 'required|in:Laki-Laki,Perempuan',
            'status' => 'required|in:PNS,Honorer',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($this->staff)],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
    }
}
