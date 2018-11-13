<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notificacao;
use App\Fluxo;
use App\FluxoAtividade;
use Illuminate\Support\Facades\DB;

class NotificacaoController extends Controller
{
    
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $id = Auth::id();
        $notificacoes = FluxoAtividade::join('notificacoes', 'fluxoatividade_id', '=', 'fluxoatividades.id')
            ->join('fluxos', 'fluxo_id', '=', 'fluxos.id')
            ->where([['user_id', '=', $id],['visto', '<>', '1']])
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

    public function finalizar(Request $request, $id){

        Notificacao::where('id', '=', $id)
          ->update(['visto' => 1]);

          //$fluxos = $id; 
          //dd($fluxos);
          return redirect()->route('notificacoes.index');
    }
}
