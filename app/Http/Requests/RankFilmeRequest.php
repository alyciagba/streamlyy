<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RankFilmeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'avaliacao' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:1000',
        ];
    }
}
