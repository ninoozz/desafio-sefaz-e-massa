<?php

namespace App\Actions\Programa;

use App\Services\ProgramaService;
use Illuminate\Database\Eloquent\Collection;

class ListProgramasAction
{
    public function __construct(private readonly ProgramaService $programas) {}

    public function execute(): Collection
    {
        return $this->programas->list();
    }
}
