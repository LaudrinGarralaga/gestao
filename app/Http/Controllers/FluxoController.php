<?php

namespace App\Http\Controllers;

use App\Equipe;
use App\Fluxo;
use App\FluxoAtividade;
use App\Notificacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FluxoController extends Controller
{

    public function index()
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $fluxos = Fluxo::paginate(10);

        return view('listas.fluxo_list', compact('fluxos'));
    }

    public function create()
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        // indica inclusão
        $acao = 1;

        $equipes = Equipe::orderBy('nome')->get();

        return view('formularios.fluxo_form', compact('acao', 'equipes'));
    }

    public function store(Request $request)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        // recupera todos os campos do formulário
        $equipe = $request->equipe;
        $precedencia = $request->precedencia;

        $fluxo = new Fluxo;
        $fluxo->descricao = $request->descricao;
        $fluxo->save();

        $id = DB::getPdo()->lastInsertId();

        for ($i = 0; $i < count($request->equipe); $i++) {
            FluxoAtividade::create([
                'fluxo_id' => $id,
                'equipe_id' => $request->equipe[$i],
                'precedencia' => $request->precedencia[$i],
            ]);
        }

        $teste = FluxoAtividade::join('equipes', 'equipe_id', '=', 'equipes.id')
            ->select('fluxoatividades.id','fluxoatividades.equipe_id', 'equipes.user_id')
            ->where([
                ['precedencia', '=', 1],
                ['fluxo_id', '=', $id]
            ])->get();
        
        for ($i = 0; $i < count($teste); $i++) { 
            Notificacao::create([
                'user_id' => $teste[$i]->user_id,
                'atividade_id' => $teste[$i]->id,
            ]);
        }

        return redirect()->route('fluxos.index')
            ->with('status', $request->descricao . ' Cadastrado!');

    }

    public function show($id)
    {

        $regs = Fluxo::find($id);

        return view('listas.fluxodetalhes_list', compact('regs'));

    }

    public function edit($id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        // obtém os dados do registro a ser editado
        $reg = Fluxo::find($id);

        /* if (Gate::denies('Atu_Area', $reg)) {
        abort(403, 'Não autorizado');
        }
         */

        // indica ao form que será alteração
        $acao = 2;

        return view('formularios.fluxo_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = Fluxo::find($id);

        /*
        if (Gate::denies('Atu_Area', $reg)) {
        abort(403, 'Não autorizado');
        }
         */

        $dados = $request->all();
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('fluxos.index')
                ->with('status', $request->descricao . ' Alterado!');
        }
    }

    public function destroy($id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $fluxo = Fluxo::find($id);
        if ($fluxo->delete()) {
            return redirect()->route('fluxos.index')
                ->with('status', $fluxo->descricao . ' Excluído!');
        }
    }

    public function detalhes($id)
    {

        $fluxoatividades = Fluxoatividade::where('fluxo_id', '=', $id)->get();
        $fluxos = Fluxo::where('id', '=', $id)->get();

        return view('listas.fluxodetalhes_list', compact('fluxoatividades', 'fluxos'));
    }

    public function adicionar($id)
    {

        $equipes = Equipe::orderBy('nome')->get();
        $titulos = DB::table('fluxos')->where('id', '=', $id)->get();
        $acao = 1;

        return view('formularios.fluxoadicionar_form', compact('acao', 'equipes', 'id', 'titulos'));
    }

    public function adicionarSalvar(Request $request, $id)
    {

        $fluxoadd = new FluxoAtividade;
        $fluxoadd->equipe_id = $request->equipe_id;
        $fluxoadd->fluxo_id = $id;
        $fluxoadd->precedencia = $request->precedencia;
        $fluxoadd->save();

        if ($fluxoadd) {
            return redirect()->route('fluxos.index')
                ->with('status', $request->atividade . ' Incluído!');
        }
    }

    public function finalizar(Request $request, $id){

        Fluxoatividade::where('id', '=', $id)
          ->update(['finalizado' => 1]);

          $fluxos = $id; 
          //dd($fluxos);
          return redirect()->route('fluxos.index');
    }

}
