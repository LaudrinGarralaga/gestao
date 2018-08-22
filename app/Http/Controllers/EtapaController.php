<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etapa;
use App\Fluxo;
use App\Area;
use Illuminate\Support\Facades\Auth;

class EtapaController extends Controller {

    public function index() {

        if (!Auth::check()) {
            return redirect('/');
        }

        //$areas = Area::where('user_id', auth()->user()->id)->get();
        $etapas = Etapa::paginate(10);

        return view('listas.etapa_list', compact('etapas'));
    }

    public function create() {

        if (!Auth::check()) {
            return redirect('/');
        }

        // indica inclusão
        $acao = 1;

        $areas = Area::orderBy('sigla')->get();
        $fluxos = Fluxo::orderBy('descricao')->get();

        return view('formularios.etapa_form', compact('acao', 'areas', 'fluxos'));
    }

    public function store(Request $request) {

        if (!Auth::check()) {
            return redirect('/');
        }
        
        // recupera todos os campos do formulário
        $dados = $request->all();
        // insere os dados na tabela
        $etapas = Etapa::create($dados);
        
        if ($etapas) {
            return redirect()->route('etapas.index')
                            ->with('status', $request->sigla . ' Incluído!');
        }
    }

    public function show($id) {
        
    }

    public function edit($id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        // obtém os dados do registro a ser editado 
        $reg = Etapa::find($id);

        /* if (Gate::denies('Atu_Area', $reg)) {
          abort(403, 'Não autorizado');
          }
         */

        // indica ao form que será alteração
        $acao = 2;

        $areas = Area::orderBy('sigla')->get();
        $fluxos = Fluxo::orderBy('descricao')->get();
        
        return view('formularios.etapa_form', compact('reg', 'acao', 'areas', 'fluxos'));
    }

    public function update(Request $request, $id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = Etapa::find($id);

        /*
          if (Gate::denies('Atu_Area', $reg)) {
          abort(403, 'Não autorizado');
          }
         */

        $dados = $request->all();
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('etapas.index')
                            ->with('status', $request->sigla . ' Alterado!');
        }
    }

    public function destroy($id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        $etapa = Etapa::find($id);
        if ($etapa->delete()) {
            return redirect()->route('etapas.index')
                            ->with('status', $etapa->sigla . ' Excluído!');
        }
    }

}
