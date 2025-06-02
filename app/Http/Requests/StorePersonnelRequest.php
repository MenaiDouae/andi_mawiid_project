<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonnelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'cnie' => 'nullable|string|max:20|unique:personnels',
            'adresse' => 'nullable|string|max:255',
            'num_tel' => 'nullable|string|max:20',
            'sexe' => 'nullable|integer|in:1,2', //
            'email' => 'required|email|max:255|unique:user,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ];
    }
}
