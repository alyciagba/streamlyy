<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreListaRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only authenticated users may create lists
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
        ];
    }
}
