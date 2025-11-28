<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddFilmeToListRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Controller will also authorize the specific lista via policy
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'lista_id' => 'required|integer|exists:listas,id',
            'filme_id' => 'required|integer|exists:filmes,id',
        ];
    }
}
