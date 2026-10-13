<?php

namespace App\Actions\Programa;

use App\Models\Programa;
use App\Services\ProgramaService;

class ShowProgramaAction
{
    public function __construct(private readonly ProgramaService $programas) {}

    public function execute(int $id): Programa
    {
        return $this->programas->find($id);
    }
}
