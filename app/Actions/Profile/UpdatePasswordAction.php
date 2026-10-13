<?php

namespace App\Actions\Profile;

use App\Models\User;
use App\Services\UserService;

class UpdatePasswordAction
{
    public function __construct(private readonly UserService $users) {}

    public function execute(User $user, string $newPassword): void
    {
        $this->users->updatePassword($user, $newPassword);
    }
}
