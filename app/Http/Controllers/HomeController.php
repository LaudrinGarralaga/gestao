<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Notificacao;
use App\FluxoAtividade;
use App\Equipe;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        
        $notificacao = Notificacao::where([
            ['user_id', '=', $id],
            ['visto', '=', 0]
        ])
        ->count();
        
        return view('home', compact('notificacao'));
    }
}
