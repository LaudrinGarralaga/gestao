<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipe;
use App\Area;
use App\User;

class EquipeController extends Controller {

    public function index() {

        //$areas = Area::where('user_id', auth()->user()->id)->get();
        $equipes = Equipe::paginate(10);

        return view('listas.equipe_list', compact('equipes'));
    }

    public function create() {

        // indica inclusão
        $acao = 1;

        $areas = Area::orderBy('sigla')->get();

        return view('formularios.equipe_form', compact('acao', 'areas'));
    }

    public function store(Request $request) {

        // recupera todos os campos do formulário
        $dados = $request->all();
        // insere os dados na tabela
        $car = Equipe::create($dados);

        if ($car) {
            return redirect()->route('equipes.index')
                            ->with('status', $request->sigla . ' Incluído!');
        }
    }

    public function show($id) {
        
    }

    public function edit($id) {

        // obtém os dados do registro a ser editado 
        $reg = Equipe::find($id);

        // indica ao form que será alteração
        $acao = 2;

        $areas = Area::orderBy('sigla')->get();

        return view('formularios.equipe_form', compact('reg', 'acao', 'areas'));
    }

    public function update(Request $request, $id) {

        $reg = Equipe::find($id);

        $dados = $request->all();

        $alt = $reg->update($dados);

        if ($alt) {
            return redirect()->route('equipes.index')
                            ->with('status', $request->sigla . ' Alterado!');
        }
    }

    public function destroy($id) {

        $equipe = Equipe::find($id);

        if ($equipe->delete()) {
            return redirect()->route('equipes.index')
                            ->with('status', $equipe->sigla . ' Excluído!');
        }
    }

    public function adicionar($id) {

        // indica inclusão
        $acao = 1;
        
        $users = User::orderBy('name')->get();
        $equipes = Equipe::orderBy('nome')->get();

        return view('formularios.equipemembros_form', compact('acao', 'users', 'equipes'));
    }

}
