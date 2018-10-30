<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index()
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $niveis = $this->role::paginate(5);
        return view('listas.nivel_list', compact('niveis'));
    }

    public function create()
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        // indica inclusão
        $acao = 1;

        return view('formularios.nivel_form', compact('acao'));
    }

    public function store(Request $request)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        // recupera todos os campos do formulário
        $dados = $request->all();
        // insere os dados na tabela
        $car = Role::create($dados);
        if ($car) {
            return redirect()->route('niveis.index')
                ->with('status', $request->name . ' Incluído!');
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
        $reg = Role::find($id);

        // indica ao form que será alteração
        $acao = 2;
        return view('formularios.nivel_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = Role::find($id);
        $dados = $request->all();
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('niveis.index')
                ->with('status', $request->name . ' Alterado!');
        }
    }

    public function destroy($id)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $nivel = Role::find($id);
        if ($nivel->delete()) {
            return redirect()->route('niveis.index')
                ->with('status', $nivel->name . ' Excluído!');
        }
    }

}
