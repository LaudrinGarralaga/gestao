<?php

namespace App\Http\Controllers;

use App\Area;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
{

    public function index()
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $areas = Area::all();

        return view('listas.area_list', compact('areas'));
    }

    public function create()
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        // indica inclusão
        $acao = 1;

        $users = User::orderBy('name')->get();

        return view('formularios.area_form', compact('acao', 'users'));
    }

    public function store(Request $request)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $area = new Area;
        $area->sigla = $request->sigla;
        $area->nome = $request->nome;
        $area->user_id = \Illuminate\Support\Facades\Auth::id();
        $area->save();

        if ($area) {
            return redirect()->route('areas.index')
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

        /* if (Gate::denies('Atu_Area', $reg)) {
        abort(403, 'Não autorizado');
        }
         */

        // indica ao form que será alteração
        $acao = 2;

        $users = User::orderBy('name')->get();
        $responsaveis = User::orderBy('name')->get();
        return view('formularios.area_form', compact('reg', 'acao', 'users', 'responsaveis'));
    }

    public function update(Request $request, $id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = Area::find($id);

        /*
        if (Gate::denies('Atu_Area', $reg)) {
        abort(403, 'Não autorizado');
        }
         */

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

        $area = Area::find($id);
        if ($area->delete()) {
            return redirect()->route('areas.index')
                ->with('status', $area->sigla . ' Excluído!');
        }
    }

}
