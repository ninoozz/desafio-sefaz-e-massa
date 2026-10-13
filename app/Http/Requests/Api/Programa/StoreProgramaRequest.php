<?php

namespace App\Http\Requests\Api\Programa;

use App\Http\Requests\Api\AdminRequest;

class StoreProgramaRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'categoria' => ['required', 'string', 'max:255'],
            'link_oficial' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'descricao.required' => 'A descrição é obrigatória.',
            'categoria.required' => 'A categoria é obrigatória.',
        ];
    }
}
