<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Permission;

class PermissionController extends Controller {

    private $permission;

    public function __construct(Permission $permission) {
        $this->permission = $permission;
    }

    public function index() {

        if (!Auth::check()) {
            return redirect('/');
        }

        $permissoes = $this->permission::paginate(10);
        return view('listas.permissao_list', compact('permissoes'));
    }

    public function create() {

        if (!Auth::check()) {
            return redirect('/');
        }

        // indica inclusão
        $acao = 1;

        return view('formularios.permissao_form', compact('acao'));
    }

    public function store(Request $request) {

        if (!Auth::check()) {
            return redirect('/');
        }

        // recupera todos os campos do formulário
        $dados = $request->all();
        // insere os dados na tabela
        $car = Permission::create($dados);
        if ($car) {
            return redirect()->route('permissoes.index')
                            ->with('status', $request->name . ' Incluído!');
        }
    }

    public function show($id) {
        
    }

    public function edit($id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        // obtém os dados do registro a ser editado 
        $reg = Permission::find($id);

        // indica ao form que será alteração
        $acao = 2;
        return view('formularios.permissao_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = Permission::find($id);
        $dados = $request->all();
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('permissoes.index')
                            ->with('status', $request->name . ' Alterado!');
        }
    }

    public function destroy($id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        $permissao = Permission::find($id);
        if ($permissao->delete()) {
            return redirect()->route('permissoes.index')
                            ->with('status', $permissao->name . ' Excluído!');
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
