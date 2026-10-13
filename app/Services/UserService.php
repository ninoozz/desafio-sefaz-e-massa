<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Operações de persistência de usuários.
 */
class UserService
{
    public const ROLE_USER = 'user';

    /**
     * Cria um usuário comum. O papel é sempre "user": ninguém se cadastra como admin.
     */
    public function createCommonUser(string $name, string $email, string $password): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => self::ROLE_USER,
        ]);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * Atualiza nome e e-mail. Se o e-mail mudar, a verificação é removida.
     */
    public function updateProfile(User $user, string $name, string $email): User
    {
        $user->fill(['name' => $name, 'email' => $email]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return $user;
    }

    public function updatePassword(User $user, string $newPassword): void
    {
        $user->update(['password' => Hash::make($newPassword)]);
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
