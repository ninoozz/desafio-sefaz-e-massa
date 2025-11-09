<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $programas = Programa::all();
        return view('programas.index', compact('programas'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        return view('programas.create');
    }


    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        Programa::create($request->all());
        
        return redirect()->route('programas.index')->with('success', 'Programa criado com sucesso!');
    }


    public function edit($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        $programa = Programa::findOrFail($id);
        return view('programas.edit', compact('programa'));
    }


    public function update(Request $request, $id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        $programa = Programa::findOrFail($id);
        $programa->update($request->all());

        return redirect()->route('programas.index')->with('success', 'Programa atualizado com sucesso!');
    }


    public function destroy($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        Programa::destroy($id);

        return redirect()->route('programas.index')->with('success', 'Programa removido com sucesso!');
    }
    
}
