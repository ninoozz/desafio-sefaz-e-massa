<?php

namespace App\Actions\Programa;

use App\Models\Programa;
use App\Services\ProgramaService;

class UpdateProgramaAction
{
    public function __construct(private readonly ProgramaService $programas) {}

    /**
     * @param  array{nome: string, descricao: string, categoria: string, link_oficial?: string|null}  $data
     */
    public function execute(int $id, array $data): Programa
    {
        $programa = $this->programas->find($id);

        return $this->programas->update($programa, $data);
    }
}
