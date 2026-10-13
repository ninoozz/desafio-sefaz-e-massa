<?php

namespace App\Actions\Profile;

use App\Models\User;
use App\Services\UserService;

class UpdateProfileAction
{
    public function __construct(private readonly UserService $users) {}

    public function execute(User $user, string $name, string $email): User
    {
        return $this->users->updateProfile($user, $name, $email);
    }
}
