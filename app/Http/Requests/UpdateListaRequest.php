<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListaRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Authorization is handled in controller via policy
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
        ];
    }
}
