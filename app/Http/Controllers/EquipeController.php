<?php

namespace App\Http\Controllers;

use App\Area;
use App\Equipe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EquipeController extends Controller
{

    public function index()
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        //$areas = Area::where('user_id', auth()->user()->id)->get();
        $equipes = Equipe::All();

        return view('listas.equipe_list', compact('equipes'));
    }

    public function create()
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        // indica inclusão
        $acao = 1;

        $areas = Area::orderBy('sigla')->get();
        $responsaveis = User::orderBy('name')->get();

        return view('formularios.equipe_form', compact('acao', 'areas', 'responsaveis'));
    }

    public function store(Request $request)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        // recupera todos os campos do formulário
        $dados = $request->all();
        // insere os dados na tabela
        $car = Equipe::create($dados);

        if ($car) {
            return redirect()->route('equipes.index')
                ->with('status', $request->sigla . ' Incluído!');
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        // obtém os dados do registro a ser editado
        $reg = Equipe::find($id);

        // indica ao form que será alteração
        $acao = 2;

        $areas = Area::orderBy('sigla')->get();
        $responsaveis = User::orderBy('name')->get();

        return view('formularios.equipe_form', compact('reg', 'acao', 'areas', 'responsaveis'));
    }

    public function update(Request $request, $id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = Equipe::find($id);

        $dados = $request->all();

        $alt = $reg->update($dados);

        if ($alt) {
            return redirect()->route('equipes.index')
                ->with('status', $request->sigla . ' Alterado!');
        }
    }

    public function destroy($id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $equipe = Equipe::find($id);

        if ($equipe->delete()) {
            return redirect()->route('equipes.index')
                ->with('status', $equipe->sigla . ' Excluído!');
        }
    }

    public function detalhes($id)
    {

        $titulos = DB::table('equipes')
            ->select('nome')
            ->where('id', '=', $id)
            ->get();

        $equipemembros = DB::table('membrosequipes')
            ->join('equipes', 'membrosequipes.equipe_id', '=', 'equipes.id')
            ->join('users', 'membrosequipes.user_id', '=', 'users.id')
            ->select('users.name', 'equipes.nome', 'membrosequipes.id', 'membrosequipes.equipe_id')
            ->where('equipe_id', '=', $id)
            ->get();

        if ($equipemembros->isEmpty()) {
            $equipemembros->equipe_id = $id;
        }

        return view('listas.equipedetalhes_list', compact('equipemembros', 'titulos', 'id'));
    }

    public function responsavel($id)
    {
        $membroID = DB::table('membrosequipes')
            ->select('user_id', 'equipe_id')
            ->where('id', '=', $id)
            ->get();

        for ($i = 0; $i < count($membroID); $i++) {
            Equipe::where('id', '=', $membroID[$i]->equipe_id)
                ->update(['user_id' => $membroID[$i]->user_id]);

        }

        return redirect()->route('equipes.index')
            ->with('status', ' Responsável Alterado!');
    }
}
