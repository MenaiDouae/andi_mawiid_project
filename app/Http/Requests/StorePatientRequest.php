<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'cnie' => 'nullable|string|max:20|unique:patients',
            'date_naissance' => 'nullable|date',
            'adresse' => 'nullable|string',
            'num_tel' => 'required|string|max:20',
            'sexe' => 'required|integer|in:1,2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ];
    }
}
