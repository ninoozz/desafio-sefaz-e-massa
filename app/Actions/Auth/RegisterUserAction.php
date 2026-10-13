<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Services\AuthTokenService;
use App\Services\UserService;

class RegisterUserAction
{
    public function __construct(
        private readonly UserService $users,
        private readonly AuthTokenService $tokens,
    ) {}

    /**
     * Cadastra um usuário comum e já devolve um token de acesso.
     *
     * @return array{user: User, token: string}
     */
    public function execute(string $name, string $email, string $password): array
    {
        $user = $this->users->createCommonUser($name, $email, $password);

        return [
            'user' => $user,
            'token' => $this->tokens->issueToken($user),
        ];
    }
}
