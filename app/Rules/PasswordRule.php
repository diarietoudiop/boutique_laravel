<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class PasswordRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $messages = [
            'required' => 'Le champ :attribute est obligatoire.',
            'min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'letters' => 'Le mot de passe doit contenir au moins une lettre.',
            'mixed_case' => 'Le mot de passe doit contenir à la fois des lettres majuscules et minuscules.',
            'numbers' => 'Le mot de passe doit contenir au moins un chiffre.',
            'symbols' => 'Le mot de passe doit contenir au moins un caractère spécial.',
        ];

        // Créer un validateur pour le mot de passe avec les règles spécifiques
        $validator = Validator::make([$attribute => $value], [
            $attribute => [
                'required',
                'string',
                Password::min(5)              // Minimum 5 caractères
                    ->letters()           // Doit contenir des lettres
                    ->mixedCase()         // Lettres majuscules et minuscules
                    ->numbers()           // Doit contenir des chiffres
                    ->symbols()           // Doit contenir des caractères spéciaux
            ],
        ], $messages);

        // Si le validateur échoue, transmettre les messages d'erreur
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $fail($error);
            }
        }
    }
}
