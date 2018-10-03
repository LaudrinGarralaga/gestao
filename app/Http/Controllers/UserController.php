<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller {

    
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $users = User::All();

        return view('listas.user_list', compact('users'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        // indica inclusão
        $acao = 1;

        return view('formularios.users_form', compact('acao'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($user) {
            return redirect()->route('users.index')
                            ->with('status', $request->name . ' Incluído!');
        }
    }
   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        // obtém os dados do registro a ser editado 
        $reg = User::find($id);

        /* if (Gate::denies('Atu_Area', $reg)) {
          abort(403, 'Não autorizado');
          }
         */

        // indica ao form que será alteração
        $acao = 2;

        return view('formularios.users_form', compact('reg', 'acao'));
    }
  
    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = User::find($id);
        //dd($reg);

        /*
          if (Gate::denies('Atu_Area', $reg)) {
          abort(403, 'Não autorizado');
          }
         */

        $user1 = $request->name;
        $user2 = $request->email;
        $user3 = bcrypt($request->password); 
        $dados = DB::table('users')
            ->where('id', $id)
            ->update(['name' => $user1, 'email' => $user2, 'password' => $user3]);

            if ($dados) {
                return redirect()->route('users.index')
                                ->with('status', $request->name . ' Alterado!');
            }
        
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            return redirect()->route('users.index')
                            ->with('status', $user->name . ' Excluído!');
        }
    }

}
