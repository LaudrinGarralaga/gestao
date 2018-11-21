<?php

namespace App\Http\Controllers;

use App\FluxoAtividade;
use App\Notificacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacaoController extends Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $id = Auth::id();
        $notificacoes = FluxoAtividade::join('notificacoes', 'atividade_id', '=', 'fluxoatividades.id')
            ->join('fluxos', 'fluxo_id', '=', 'fluxos.id')
            ->where([['user_id', '=', $id], ['visto', '<>', '1']])
            ->get();

        /*$dados = DB::table('notificacoes')
        ->where('user_id', '=', $id)
        ->update(['visto' => 1]);*/

        return view('listas.notificacoes_list', compact('notificacoes'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public function finalizar(Request $request, $id)
    {

        Notificacao::where('id', '=', $id)
            ->update(['visto' => 1]);

        //$fluxos = $id;
        //dd($fluxos);
        return redirect()->route('notificacoes.index');
    }
}
