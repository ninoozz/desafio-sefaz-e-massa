<?php

namespace Tests\Feature\Api;

use App\Models\Programa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProgramaApiTest extends TestCase
{
    use RefreshDatabase;

    private function dadosValidos(array $sobrescrever = []): array
    {
        return array_merge([
            'nome' => 'Programa de Incentivo',
            'descricao' => 'Incentivo fiscal para novas empresas.',
            'categoria' => 'Incentivo Fiscal',
            'link_oficial' => 'https://example.com/programa',
        ], $sobrescrever);
    }

    private function criarPrograma(): Programa
    {
        return Programa::create($this->dadosValidos());
    }

    private function loginComo(string $role): User
    {
        $user = User::factory()->create(['role' => $role]);
        Sanctum::actingAs($user);

        return $user;
    }

    public function test_listagem_de_programas_e_publica(): void
    {
        $this->criarPrograma();

        $this->getJson('/api/programas')
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonPath('0.nome', 'Programa de Incentivo');
    }

    public function test_detalhe_de_programa_exige_login(): void
    {
        $programa = $this->criarPrograma();

        $this->getJson("/api/programas/{$programa->id}")->assertUnauthorized();
    }

    public function test_usuario_logado_ve_detalhe_de_programa(): void
    {
        $programa = $this->criarPrograma();
        $this->loginComo('user');

        $this->getJson("/api/programas/{$programa->id}")
            ->assertOk()
            ->assertJsonPath('id', $programa->id);
    }

    public function test_detalhe_de_programa_inexistente_retorna_404(): void
    {
        $this->loginComo('user');

        $this->getJson('/api/programas/999')->assertNotFound();
    }

    public function test_id_que_nao_e_numero_retorna_404(): void
    {
        $this->loginComo('admin');

        $this->getJson('/api/programas/abc')->assertNotFound();
        $this->deleteJson('/api/programas/abc')->assertNotFound();
    }

    public function test_admin_ao_excluir_programa_inexistente_recebe_404(): void
    {
        $this->loginComo('admin');

        $this->deleteJson('/api/programas/999')->assertNotFound();
    }

    public function test_admin_pode_criar_programa(): void
    {
        $this->loginComo('admin');

        $this->postJson('/api/programas', $this->dadosValidos())
            ->assertCreated()
            ->assertJsonPath('nome', 'Programa de Incentivo');

        $this->assertDatabaseHas('programas', ['nome' => 'Programa de Incentivo']);
    }

    public function test_criacao_valida_campos_obrigatorios(): void
    {
        $this->loginComo('admin');

        $this->postJson('/api/programas', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['nome', 'descricao', 'categoria']);
    }

    public function test_usuario_comum_nao_pode_criar_programa(): void
    {
        $this->loginComo('user');

        $this->postJson('/api/programas', $this->dadosValidos())
            ->assertForbidden()
            ->assertJsonPath('message', 'Você não tem permissão para realizar esta ação.');

        $this->assertDatabaseCount('programas', 0);
    }

    public function test_visitante_nao_pode_criar_programa(): void
    {
        $this->postJson('/api/programas', $this->dadosValidos())->assertUnauthorized();
    }

    public function test_admin_pode_editar_programa(): void
    {
        $programa = $this->criarPrograma();
        $this->loginComo('admin');

        $this->putJson("/api/programas/{$programa->id}", $this->dadosValidos(['nome' => 'Nome novo']))
            ->assertOk()
            ->assertJsonPath('nome', 'Nome novo');

        $this->assertDatabaseHas('programas', ['id' => $programa->id, 'nome' => 'Nome novo']);
    }

    public function test_usuario_comum_nao_pode_editar_programa(): void
    {
        $programa = $this->criarPrograma();
        $this->loginComo('user');

        $this->putJson("/api/programas/{$programa->id}", $this->dadosValidos(['nome' => 'Hackeado']))
            ->assertForbidden();

        $this->assertDatabaseHas('programas', ['id' => $programa->id, 'nome' => 'Programa de Incentivo']);
    }

    public function test_admin_pode_excluir_programa(): void
    {
        $programa = $this->criarPrograma();
        $this->loginComo('admin');

        $this->deleteJson("/api/programas/{$programa->id}")
            ->assertOk()
            ->assertJsonPath('message', 'Programa deletado com sucesso.');

        $this->assertDatabaseMissing('programas', ['id' => $programa->id]);
    }

    public function test_usuario_comum_nao_pode_excluir_programa(): void
    {
        $programa = $this->criarPrograma();
        $this->loginComo('user');

        $this->deleteJson("/api/programas/{$programa->id}")->assertForbidden();

        $this->assertDatabaseHas('programas', ['id' => $programa->id]);
    }
}
