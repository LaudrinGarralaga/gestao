<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use App\RoleUser;

class RegraController extends Controller {

    public function index() {

        /* $rusers = DB::table('role_user')
          ->join('roles', 'role_user.id', '=', 'roles.id')
          ->join('users', 'role_user.id', '=', 'users.id')
          ->select('role_user.*', 'roles.name', 'users.name as nome')
          ->paginate(2);
         */

        $rusers = RoleUser::paginate(5);

        return view('listas.ruser_list', compact('rusers'));
    }

    public function create() {

        // indica inclusão
        $acao = 1;

        // obtém as marcas para exibir no form de cadastro
        $roles = Role::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('formularios.ruser_form', compact('acao', 'roles', 'users'));
    }

    public function store(Request $request) {

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

    public function show($id) {
        //
    }

    public function edit($id) {

        // obtém os dados do registro a ser editado 
        $reg = RoleUser::find($id);

        // obtém as marcas para exibir no form de cadastro
        $roles = Role::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        // indica ao form que será alteração
        $acao = 2;
        return view('formularios.ruser_form', compact('reg', 'acao', 'roles', 'users'));
    }

    public function update(Request $request, $id) {

        $reg = RoleUser::find($id);
        $dados = $request->all();
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('rusers.index')
                            ->with('status', $request->id . ' Alterado!');
        }
    }

    public function destroy($id) {
        
        $regra = RoleUser::find($id);
        
        if ($regra->delete()) {
            return redirect()->route('rusers.index')
                            ->with('status', $regra->id . ' Excluído!');
        }
    }

    public function foto($id) {

        // obtém os dados do registro a ser exibido
        $reg = Carro::find($id);
        // obtém as marcas para exibir no form de cadastro
        $marcas = Marca::orderBy('nome')->get();
        return view('carros_foto', compact('reg', 'marcas'));
    }

    public function storefoto(Request $request) {
        // recupera todos os campos do formulário
        $dados = $request->all();
        $id = $dados['id'];
        if (isset($dados['foto'])) {
            $fotoId = $id . '.jpg';
            $request->foto->move(public_path('fotos'), $fotoId);
        }
        return redirect()->route('carros.index')
                        ->with('status', $request->modelo . ' com Foto Cadastrada!');
    }

    public function pesq() {
        // se não estiver autenticado, redireciona para login
        if (!Auth::check()) {
            return redirect('/');
        }
        $carros = Carro::paginate(3);
        return view('carros_pesq', compact('carros'));
    }

    public function filtro(Request $request) {
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
        $carros = DB::table('carros')
                ->join('marcas', 'carros.marca_id', '=', 'marcas.id')
                ->select('marcas.nome as marca', DB::raw('count(*) as num'))
                ->groupBy('marcas.nome')
                ->get();
        return view('carros_graf', compact('carros'));
    }

}
