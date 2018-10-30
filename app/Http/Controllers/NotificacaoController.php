<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notificacao;

class NotificacaoController extends Controller
{
    
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $id = Auth::id();
        $notificacoes = Notificacao::where([
            ['user_id', '=', $id],
            ['visto', '<>', '1']
            ])->GET();
        
        //dd($notificacoes);

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
