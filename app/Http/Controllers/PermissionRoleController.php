<?php

namespace App\Http\Controllers;

use App\Permission;
use App\PermissionRole;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionRoleController extends Controller
{

    public function index()
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $proles = PermissionRole::paginate(10);
        return view('listas.prole_list', compact('proles'));
    }

    public function create()
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        // indica inclusão
        $acao = 1;

        $roles = Role::orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get();

        return view('formularios.prole_form', compact('acao', 'roles', 'permissions'));
    }

    public function store(Request $request)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        // recupera todos os campos do formulário
        $dados = $request->all();

        // insere os dados na tabela
        $car = PermissionRole::create($dados);

        if ($car) {
            return redirect()->route('proles.index')
                ->with('status', $request->id . ' Incluído!');
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
        $reg = PermissionRole::find($id);

        $roles = Role::orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get();

        // indica ao form que será alteração
        $acao = 2;

        return view('formularios.prole_form', compact('reg', 'acao', 'roles', 'permissions'));
    }

    public function update(Request $request, $id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = PermissionRole::find($id);
        $dados = $request->all();
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('proles.index')
                ->with('status', $request->sigla . ' Alterado!');
        }
    }

    public function destroy($id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $prole = PermissionRole::find($id);
        if ($prole->delete()) {
            return redirect()->route('proles.index')
                ->with('status', $prole->sigla . ' Excluído!');
        }
    }

}
