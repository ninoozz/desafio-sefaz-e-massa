<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Credenciais e tokens de API (Laravel Sanctum).
 */
class AuthTokenService
{
    private const TOKEN_NAME = 'auth_token';

    public function __construct(private readonly UserService $users) {}

    /**
     * Retorna o usuário se e-mail e senha conferirem, ou null caso contrário.
     */
    public function validateCredentials(string $email, string $password): ?User
    {
        $user = $this->users->findByEmail($email);

        if (! $user || ! Hash::check($password, $user->password)) {
            return null;
        }

        return $user;
    }

    public function issueToken(User $user): string
    {
        return $user->createToken(self::TOKEN_NAME)->plainTextToken;
    }

    public function revokeCurrentToken(User $user): void
    {
        $user->currentAccessToken()?->delete();
    }

    public function revokeAllTokens(User $user): void
    {
        $user->tokens()->delete();
    }
}
