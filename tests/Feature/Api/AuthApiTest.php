<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_pode_se_registrar_e_recebe_token(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Maria',
            'email' => 'maria@example.com',
            'password' => 'senha-segura-123',
            'password_confirmation' => 'senha-segura-123',
        ]);

        $response->assertCreated()
            ->assertJsonStructure(['user' => ['id', 'name', 'email', 'role'], 'token'])
            ->assertJsonPath('user.role', 'user');

        $this->assertDatabaseHas('users', ['email' => 'maria@example.com', 'role' => 'user']);
    }

    public function test_registro_ignora_tentativa_de_se_cadastrar_como_admin(): void
    {
        $this->postJson('/api/register', [
            'name' => 'Espertinho',
            'email' => 'esperto@example.com',
            'password' => 'senha-segura-123',
            'password_confirmation' => 'senha-segura-123',
            'role' => 'admin',
        ])->assertCreated()->assertJsonPath('user.role', 'user');
    }

    public function test_registro_valida_campos_obrigatorios(): void
    {
        $this->postJson('/api/register', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    public function test_registro_rejeita_email_duplicado(): void
    {
        User::factory()->create(['email' => 'repetido@example.com']);

        $this->postJson('/api/register', [
            'name' => 'Outro',
            'email' => 'repetido@example.com',
            'password' => 'senha-segura-123',
            'password_confirmation' => 'senha-segura-123',
        ])->assertUnprocessable()->assertJsonValidationErrors(['email']);
    }

    public function test_usuario_pode_fazer_login(): void
    {
        $user = User::factory()->create();

        $this->postJson('/api/login', ['email' => $user->email, 'password' => 'password'])
            ->assertOk()
            ->assertJsonStructure(['user', 'token'])
            ->assertJsonPath('user.email', $user->email);
    }

    public function test_login_com_senha_errada_falha(): void
    {
        $user = User::factory()->create();

        $this->postJson('/api/login', ['email' => $user->email, 'password' => 'errada'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_rota_de_usuario_exige_autenticacao(): void
    {
        $this->getJson('/api/user')->assertUnauthorized();
    }

    public function test_usuario_autenticado_ve_seus_dados_e_faz_logout(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('teste')->plainTextToken;

        $this->withToken($token)->getJson('/api/user')
            ->assertOk()
            ->assertJsonPath('id', $user->id);

        $this->withToken($token)->postJson('/api/logout')->assertOk();

        $this->assertDatabaseCount('personal_access_tokens', 0);
    }
}
