<?php

namespace App\Http\Controllers;

use App\Equipe;
use App\Http\Requests\UserStoreUpdateFormRequest;
use App\Membrosequipe;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

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

        $equipes = Equipe::orderBy('nome')->get();

        return view('formularios.users_form', compact('acao', 'equipes'));
    }

    public function store(UserStoreUpdateFormRequest $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $id = $user->id;

        $membroequipe = new Membrosequipe;
        $membroequipe->user_id = $id;
        $membroequipe->equipe_id = $request->equipe_id;
        $membroequipe->save();

        if ($membroequipe) {
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

        //$reg = User::with('membrosequipe')->where('id', $id)->get();
        //dd($reg);

        /*$reg = DB::table('users')
        ->join('membrosequipes', 'users.id', '=', 'membrosequipes.user_id')
        ->select( 'users.id', 'users.name', 'users.email', 'users.password',  'users.remember_token',  'users.created_at', 'users.updated_at', 'membrosequipes.equipe_id')
        ->where('users.id', '=', $id)
        ->get();
         */

        /* if (Gate::denies('Atu_Area', $reg)) {
        abort(403, 'Não autorizado');
        }
         */

        // indica ao form que será alteração
        $acao = 2;

        $equipes = Equipe::orderBy('nome')->get();

        return view('formularios.users_form', compact('reg', 'acao', 'equipes'));
    }

    public function update(UserStoreUpdateFormRequest $request, $id)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = User::find($id);

        /*
        if (Gate::denies('Atu_Area', $reg)) {
        abort(403, 'Não autorizado');
        }
         */

        $user1 = $request->name;
        $user2 = $request->email;
        $user3 = bcrypt($request->password);
        $user4 = $request->equipe_id;

        /*$teste = DB::table('membrosequipes')
        ->where('user_id', $id)
        ->count();

        if ($teste = 0) {*/
        $user = new Membrosequipe;
        $user->user_id = $id;
        $user->equipe_id = $user4;
        $user->save();

        $dados = DB::table('users')
            ->where('id', $id)
            ->update(['name' => $user1, 'email' => $user2, 'password' => $user3]);

        if ($dados) {
            return redirect()->route('users.index')
                ->with('status', $request->name . ' Alterado!');
        }
        /* } else {

    $dados1 = DB::table('membrosequipes')
    ->where('id', $id)
    ->update(['user_id' => $id, 'equipe_id' => $user4]);

    $dados = DB::table('users')
    ->where('id', $id)
    ->update(['name' => $user1, 'email' => $user2, 'password' => $user3]);

    if ($dados) {
    return redirect()->route('users.index')
    ->with('status', $request->name . ' Alterado!');
    }*/

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
