<?php

namespace App\Services;

use App\Models\Programa;
use Illuminate\Database\Eloquent\Collection;

/**
 * Acesso a dados de programas. Não conhece HTTP nem regras de permissão.
 */
class ProgramaService
{
    /**
     * @return Collection<int, Programa>
     */
    public function list(): Collection
    {
        return Programa::all();
    }

    public function find(int $id): Programa
    {
        return Programa::findOrFail($id);
    }

    public function create(array $data): Programa
    {
        return Programa::create($data);
    }

    public function update(Programa $programa, array $data): Programa
    {
        $programa->update($data);

        return $programa;
    }

    public function delete(Programa $programa): void
    {
        $programa->delete();
    }
}
