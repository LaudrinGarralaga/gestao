<?php

namespace App\Http\Controllers;

use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegraController extends Controller
{

    public function index()
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        /* $rusers = DB::table('role_user')
        ->join('roles', 'role_user.id', '=', 'roles.id')
        ->join('users', 'role_user.id', '=', 'users.id')
        ->select('role_user.*', 'roles.name', 'users.name as nome')
        ->paginate(2);
         */

        $rusers = RoleUser::paginate(5);

        return view('listas.ruser_list', compact('rusers'));
    }

    public function create()
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        // indica inclusão
        $acao = 1;

        // obtém as marcas para exibir no form de cadastro
        $roles = Role::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('formularios.ruser_form', compact('acao', 'roles', 'users'));
    }

    public function store(Request $request)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        /*
        $role_id = $request->input('role_id');
        $user_id = $request->input('user_id');

        // insere os dados na tabela
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [$role_id, $user_id]);
         */

        // recupera todos os campos do formulário
        $dados = $request->all();

        // insere os dados na tabela
        $car = RoleUser::create($dados);

        if ($car) {
            return redirect()->route('rusers.index')
                ->with('status', $request->id . ' Incluído!');
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
        $reg = RoleUser::find($id);

        // obtém as marcas para exibir no form de cadastro
        $roles = Role::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        // indica ao form que será alteração
        $acao = 2;
        return view('formularios.ruser_form', compact('reg', 'acao', 'roles', 'users'));
    }

    public function update(Request $request, $id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = RoleUser::find($id);
        $dados = $request->all();
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('rusers.index')
                ->with('status', $request->id . ' Alterado!');
        }
    }

    public function destroy($id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $regra = RoleUser::find($id);

        if ($regra->delete()) {
            return redirect()->route('rusers.index')
                ->with('status', $regra->id . ' Excluído!');
        }
    }

}
