<?php

namespace App\Http\Requests\Api;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Base para requests que só administradores podem fazer.
 * Bloqueia usuários comuns com 403 antes de qualquer validação.
 */
abstract class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->isAdmin();
    }

    protected function failedAuthorization(): void
    {
        throw new AuthorizationException('Você não tem permissão para realizar esta ação.');
    }
}
