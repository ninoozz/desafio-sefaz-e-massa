<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProfileApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_ve_o_proprio_perfil(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->getJson('/api/profile')->assertOk()->assertJsonPath('email', $user->email);
    }

    public function test_usuario_atualiza_nome_e_email(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->patchJson('/api/profile', ['name' => 'Novo Nome', 'email' => 'novo@example.com'])
            ->assertOk()
            ->assertJsonPath('name', 'Novo Nome')
            ->assertJsonPath('email_verified_at', null);

        $this->assertDatabaseHas('users', ['id' => $user->id, 'email' => 'novo@example.com']);
    }

    public function test_manter_o_mesmo_email_nao_remove_verificacao(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->patchJson('/api/profile', ['name' => 'Outro Nome', 'email' => $user->email])->assertOk();

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_atualizar_perfil_nao_permite_virar_admin(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        Sanctum::actingAs($user);

        $this->patchJson('/api/profile', ['name' => 'X', 'email' => $user->email, 'role' => 'admin'])->assertOk();

        $this->assertSame('user', $user->refresh()->role);
    }

    public function test_usuario_troca_a_senha(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->putJson('/api/password', [
            'current_password' => 'password',
            'password' => 'nova-senha-123',
            'password_confirmation' => 'nova-senha-123',
        ])->assertOk();

        $this->assertTrue(Hash::check('nova-senha-123', $user->refresh()->password));
    }

    public function test_troca_de_senha_exige_senha_atual_correta(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->putJson('/api/password', [
            'current_password' => 'errada',
            'password' => 'nova-senha-123',
            'password_confirmation' => 'nova-senha-123',
        ])->assertUnprocessable()->assertJsonValidationErrors(['current_password']);
    }

    public function test_usuario_exclui_a_propria_conta(): void
    {
        $user = User::factory()->create();
        $user->createToken('teste');
        Sanctum::actingAs($user);

        $this->deleteJson('/api/profile', ['password' => 'password'])->assertOk();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    public function test_exclusao_de_conta_exige_senha_correta(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->deleteJson('/api/profile', ['password' => 'errada'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['password']);

        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }
}
