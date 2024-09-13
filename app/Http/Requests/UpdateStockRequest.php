<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Vous pouvez ajouter ici une logique d'autorisation si nécessaire
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'articles' => 'required|array',
            'articles.*.id' => 'required|integer|exists:articles,id',
            'articles.*.quantite' => 'required|integer',
        ];
    }
}
