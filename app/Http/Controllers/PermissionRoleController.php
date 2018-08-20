<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PermissionRole;
use App\Permission;
use App\Role;

class PermissionRoleController extends Controller {

    public function index() {

        if (!Auth::check()) {
            return redirect('/');
        }

        $proles = PermissionRole::paginate(10);
        return view('listas.prole_list', compact('proles'));
    }

    public function create() {

        if (!Auth::check()) {
            return redirect('/');
        }

        // indica inclusão
        $acao = 1;

        $roles = Role::orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get();

        return view('formularios.prole_form', compact('acao', 'roles', 'permissions'));
    }

    public function store(Request $request) {

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

    public function show($id) {
        
    }

    public function edit($id) {

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

    public function update(Request $request, $id) {

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

    public function destroy($id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        $prole = PermissionRole::find($id);
        if ($prole->delete()) {
            return redirect()->route('proles.index')
                            ->with('status', $prole->sigla . ' Excluído!');
        }
    }

    public function pesq() {

        if (!Auth::check()) {
            return redirect('/');
        }

        $carros = Carro::paginate(3);
        return view('carros_pesq', compact('carros'));
    }

    public function filtro(Request $request) {

        if (!Auth::check()) {
            return redirect('/');
        }

        // obtém dados do form de pesquisa
        $modelo = $request->modelo;
        $precomax = $request->precomax;
        $cond = array();
        if (!empty($modelo)) {
            array_push($cond, array('modelo', 'like', '%' . $modelo . '%'));
        }
        if (!empty($precomax)) {
            array_push($cond, array('preco', '<=', $precomax));
        }
        $carros = Carro::where($cond)
                        ->orderBy('modelo')->paginate(3);
        return view('carros_pesq', compact('carros'));
    }

    public function filtro2(Request $request) {

        if (!Auth::check()) {
            return redirect('/');
        }

        // obtém dados do form de pesquisa
        $modelo = $request->modelo;
        $precomax = $request->precomax;
        if (empty($precomax)) {
            $carros = Carro::where('modelo', 'like', '%' . $modelo . '%')
                            ->orderBy('modelo')->paginate(3);
        } else {
            $carros = Carro::where('modelo', 'like', '%' . $modelo . '%')
                            ->where('preco', '<=', $precomax)
                            ->orderBy('modelo')->paginate(3);
        }
        return view('carros_pesq', compact('carros'));
    }

    public function graf() {

        if (!Auth::check()) {
            return redirect('/');
        }

        $carros = DB::table('carros')
                ->join('marcas', 'carros.marca_id', '=', 'marcas.id')
                ->select('marcas.nome as marca', DB::raw('count(*) as num'))
                ->groupBy('marcas.nome')
                ->get();
        return view('carros_graf', compact('carros'));
    }

}
