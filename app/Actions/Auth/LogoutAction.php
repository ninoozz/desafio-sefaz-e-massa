<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Services\AuthTokenService;

class LogoutAction
{
    public function __construct(private readonly AuthTokenService $tokens) {}

    public function execute(User $user): void
    {
        $this->tokens->revokeCurrentToken($user);
    }
}
