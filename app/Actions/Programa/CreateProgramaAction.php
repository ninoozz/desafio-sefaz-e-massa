<?php

namespace App\Actions\Programa;

use App\Models\Programa;
use App\Services\ProgramaService;

class CreateProgramaAction
{
    public function __construct(private readonly ProgramaService $programas) {}

    /**
     * @param  array{nome: string, descricao: string, categoria: string, link_oficial?: string|null}  $data
     */
    public function execute(array $data): Programa
    {
        return $this->programas->create($data);
    }
}
