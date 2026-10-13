<?php

namespace App\Actions\Programa;

use App\Services\ProgramaService;

class DeleteProgramaAction
{
    public function __construct(private readonly ProgramaService $programas) {}

    public function execute(int $id): void
    {
        $programa = $this->programas->find($id);

        $this->programas->delete($programa);
    }
}
