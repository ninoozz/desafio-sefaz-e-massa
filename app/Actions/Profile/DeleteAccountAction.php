<?php

namespace App\Actions\Profile;

use App\Models\User;
use App\Services\AuthTokenService;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;

class DeleteAccountAction
{
    public function __construct(
        private readonly UserService $users,
        private readonly AuthTokenService $tokens,
    ) {}

    /**
     * Remove os tokens e a conta numa única transação.
     */
    public function execute(User $user): void
    {
        DB::transaction(function () use ($user) {
            $this->tokens->revokeAllTokens($user);
            $this->users->delete($user);
        });
    }
}
