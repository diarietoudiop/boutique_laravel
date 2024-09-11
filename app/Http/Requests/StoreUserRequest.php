<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PasswordRule;


class StoreUserRequest extends FormRequest
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
            'email' => 'required|string|max:255|unique:users,email', // Correction: unique pour l'email
            'role' => ['required', 'in:admin,boutiquier'], // Validation des rôles directement
            'photo' => 'required|image',
            'password' => ['required', 'confirmed', new PasswordRule()], // Ajout de 'required' pour le mot de passe
        ];
    }


    public function messages(): array
    {
        return [
            'photo.required' => 'Le photo est obligatoire',
            'photo.image' => 'Le photo doit être un image',
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.required' => "L'email est obligatoire.", // Correction du message pour l'email
            'email.unique' => 'Cet email est déjà utilisé.', // Correction: unique pour l'email
            'role.required' => 'Le rôle est obligatoire.',
            'role.in' => 'Le rôle doit être admin ou boutiquier.',
            'password.required' => 'Le mot de passe est obligatoire.', // Message pour le mot de passe
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.', // Message pour confirmation du mot de passe
        ];
    }
}
