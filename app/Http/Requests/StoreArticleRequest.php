<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Assurez-vous que l'utilisateur est autorisé à faire cette requête.
        // Par défaut, il retourne true, ce qui signifie que tout utilisateur est autorisé.
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
            'libelle' => 'required|string|max:255',
            'prix' => 'required|numeric|gt:0', // 'gt:0' garantit que le prix est supérieur à zéro
            'quantite' => 'required|integer|min:0', // 'min:0' garantit que la quantité est zéro ou positive
        ];
    }
}
