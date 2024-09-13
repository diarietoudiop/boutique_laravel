<?php

namespace App\Http\Requests;

use App\Rules\PasswordRule;
use App\Rules\TelephoneRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'surname' => ['string', 'unique:clients,surname'],
            'adresse' => ['string', 'max:255'],
            'telephone' => ['string', 'unique:clients,telephone', new TelephoneRule()],

            'user' => ['sometimes', 'array'],
            'user[nom]' => ['string'],
            'user[prenom]' => [ 'string'],
            'user[photo]' => ['image'],
            'user[email]' => ['string', 'max:255', 'unique:users,email'],
            'user[password]' => [ new PasswordRule(), 'confirmed'],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'surname.required' => "Le surnom est obligatoire.",
            'surname.unique' => "Ce surnom est déjà utilisé.",
            'telephone.required' => "Le téléphone est obligatoire.",
            'telephone.unique' => "Ce téléphone est déjà utilisé.",

            'user.nom.required_with' => "Le nom de l'utilisateur est obligatoire.",
            'user.prenom.required_with' => "Le prénom de l'utilisateur est obligatoire.",
            'user.email.required_with' => "L'email de l'utilisateur est obligatoire.",
            'user.email.unique' => "Cet email est déjà utilisé.",
            'user.password.required_with' => "Le mot de passe est obligatoire lorsque l'utilisateur est présent.",
            'user.password.confirmed' => "La confirmation du mot de passe ne correspond pas.",
            'user.photo.required_with' => "La photo est obligatoire lorsque l'utilisateur est présent.",
            'user.photo.image' => "La photo doit être une image.",
        ];
    }
}
