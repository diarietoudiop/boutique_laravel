<?php

namespace App\Http\Requests;

use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'nom' => 'sometimes|required|string|max:255',
            'prenom' => 'sometimes|required|string|max:255',
            'prenom' => 'sometimes|required|string|max:255',
            'photo' => 'sometimes|required|image',
            'login' => 'sometimes|required|string|max:255|unique:users,login',
            'role' => ['sometimes|required', 'in:' . implode(',', array_column(["admin", "boutiquier"], 'value'))],
            'password' => ['sometimes|required|confirmed', new PasswordRule()],
        ];
    }

    public function messages()
    {
        return [
            'photo.required' => 'Le photo est obligatoire',
            'photo.image' => 'Le photo doit être un image',
            'nom.required' => 'Le champ nom est obligatoire.',
            'prenom.required' => 'Le champ prénom est obligatoire.',
            'login.required' => 'Le champ login est obligatoire.',
            'login.email' => 'Le champ login doit être une adresse e-mail valide.',
            'role.required' => 'Le champ rôle est obligatoire.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'is_blocked.required' => 'Le champ est bloqué est obligatoire.',
        ];
    }
}
