<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockArticleRequest extends FormRequest
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

    public function rules()
    {
        return [
            'articles' => 'required|array',
            'articles..id' => 'required|integer',
            'articles..quantite' => 'required|integer|min:1',
        ];
    }


    public function messages()
    {
        return [
            'articles.required' => 'La liste des articles est requise.',
            'articles.array' => 'La liste des articles doit être un tableau.',
            'articles..id.required' => "L'ID de l'article est requis.",
            'articles..id.exists' => "L'ID de l'article doit exister.",
            'articles..quantite.required' => 'La quantité est requise.',
            'articles..quantite.integer' => 'La quantité doit être un entier.',
            'articles..quantite.min' => 'La quantité doit être au moins 1.',
        ];
    }
}
