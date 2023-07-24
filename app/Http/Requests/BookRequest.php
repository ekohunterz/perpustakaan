<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
            'kode_buku' => ['required', Rule::unique('books')->ignore($this->buku)],
            'nama_buku' => 'required',
            'penerbit' => 'required',
            'th_terbit' => 'required',
            'isbn' => 'required',
            'kategori_id' => 'required',
            'kondisi_buku_baik' => 'required|numeric',
            'kondisi_buku_rusak' => 'required|numeric',
            'foto_buku' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
    }
}
