<?php

namespace App\Http\Controllers;

use App\Area;
use App\Equipe;
use App\Membrosequipe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class MembrosequipeController extends Controller
{

    public function index()
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $equipemembros = Membrosequipe::All();
       
        return view('listas.equipedetalhes_list', compact('equipemembros'));
    }

    public function create($id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $titulos = DB::table('equipes')
            ->select('nome')
            ->where('id', '=', $id)
            ->get();

        // indica inclusão
        $acao = 1;

        $users = User::orderBy('name')->get();
        $equipes = Equipe::orderBy('nome')->get();

        return view('formularios.equipemembros_form', compact('acao', 'users', 'equipes', 'titulos'));
    }

    public function store(Request $request)
    {

        if (!Auth::check()) {
            return redirect('/');
        }
        
        $fluxoadd = new Membrosequipe;
        $fluxoadd->equipe_id = $request->equipe_id;
        $fluxoadd->user_id =  $request->user_id;
        $fluxoadd->save();

        if ($fluxoadd) {
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
        $reg = Area::find($id);

        // indica ao form que será alteração
        $acao = 2;

        $users = User::orderBy('name')->get();
        $equipes = Equipe::orderBy('nome')->get();

        return view('formularios.area_form', compact('reg', 'acao', 'users', 'equipes'));
    }

    public function update(Request $request, $id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = Area::find($id);

        $dados = $request->all();
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('areas.index')
                ->with('status', $request->sigla . ' Alterado!');
        }
    }

    public function destroy($id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $membroequipes = Membrosequipe::find($id);
        if ($membroequipes->delete()) {
            return Redirect::back()->with('status', 'Membro Removido !');
        }
    }

    public function adicionar($id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        $titulos = DB::table('equipes')
            ->select('nome')
            ->where('id', '=', $id)
            ->get();
    
        // indica inclusão
        $acao = 1;

        $registro = Equipe::find($id);

        $users = User::orderBy('name')->get();
       
        return view('formularios.equipemembros_form', compact('acao', 'titulos', 'users', 'registro'));
    }
    
}
