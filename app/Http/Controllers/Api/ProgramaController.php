<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Programa;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    /**
     * Listar todos os programas
     */
    public function index()
    {
        $programas = Programa::all();
        return response()->json($programas);
    }

    /**
     * Mostrar um programa específico
     */
    public function show($id)
    {
        $programa = Programa::findOrFail($id);
        return response()->json($programa);
    }

    /**
     * Criar novo programa (apenas admin)
     */
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            return response()->json([
                'message' => 'Você não tem permissão para realizar esta ação.'
            ], 403);
        }

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'categoria' => 'required|string|max:255',
            'link_oficial' => 'nullable|string|max:500',
        ], [
            'nome.required' => 'O nome é obrigatório.',
            'descricao.required' => 'A descrição é obrigatória.',
            'categoria.required' => 'A categoria é obrigatória.',
        ]);

        $programa = Programa::create($validated);

        return response()->json($programa, 201);
    }

    /**
     * Atualizar programa (apenas admin)
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->isAdmin()) {
            return response()->json([
                'message' => 'Você não tem permissão para realizar esta ação.'
            ], 403);
        }

        $programa = Programa::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'categoria' => 'required|string|max:255',
            'link_oficial' => 'nullable|string|max:500',
        ], [
            'nome.required' => 'O nome é obrigatório.',
            'descricao.required' => 'A descrição é obrigatória.',
            'categoria.required' => 'A categoria é obrigatória.',
        ]);

        $programa->update($validated);

        return response()->json($programa);
    }

    /**
     * Deletar programa (apenas admin)
     */
    public function destroy($id)
    {
        if (!auth()->user()->isAdmin()) {
            return response()->json([
                'message' => 'Você não tem permissão para realizar esta ação.'
            ], 403);
        }

        $programa = Programa::findOrFail($id);
        $programa->delete();

        return response()->json([
            'message' => 'Programa deletado com sucesso.'
        ]);
    }
}

