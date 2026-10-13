<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Services\AuthTokenService;
use Illuminate\Validation\ValidationException;

class LoginAction
{
    public function __construct(private readonly AuthTokenService $tokens) {}

    /**
     * @return array{user: User, token: string}
     *
     * @throws ValidationException quando as credenciais não conferem
     */
    public function execute(string $email, string $password): array
    {
        $user = $this->tokens->validateCredentials($email, $password);

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => ['Credenciais inválidas. Verifique seu e-mail e senha.'],
            ]);
        }

        return [
            'user' => $user,
            'token' => $this->tokens->issueToken($user),
        ];
    }
}
