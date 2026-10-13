<?php

namespace App\Http\Controllers\Api;

use App\Actions\Programa\CreateProgramaAction;
use App\Actions\Programa\DeleteProgramaAction;
use App\Actions\Programa\ListProgramasAction;
use App\Actions\Programa\ShowProgramaAction;
use App\Actions\Programa\UpdateProgramaAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Programa\DeleteProgramaRequest;
use App\Http\Requests\Api\Programa\StoreProgramaRequest;
use App\Http\Requests\Api\Programa\UpdateProgramaRequest;
use Illuminate\Http\JsonResponse;

/**
 * Recebe a requisição já validada e autorizada (Request),
 * delega o caso de uso (Action) e devolve a resposta HTTP.
 */
class ProgramaController extends Controller
{
    public function index(ListProgramasAction $action): JsonResponse
    {
        return response()->json($action->execute());
    }

    public function show(int $id, ShowProgramaAction $action): JsonResponse
    {
        return response()->json($action->execute($id));
    }

    public function store(StoreProgramaRequest $request, CreateProgramaAction $action): JsonResponse
    {
        return response()->json($action->execute($request->validated()), 201);
    }

    public function update(UpdateProgramaRequest $request, int $id, UpdateProgramaAction $action): JsonResponse
    {
        return response()->json($action->execute($id, $request->validated()));
    }

    public function destroy(DeleteProgramaRequest $request, int $id, DeleteProgramaAction $action): JsonResponse
    {
        $action->execute($id);

        return response()->json(['message' => 'Programa deletado com sucesso.']);
    }
}
