<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Area;
use App\User;
use App\Membrosequipe;
use App\Equipe;

class MembrosequipeController extends Controller {

    public function index() {

        //$areas = Area::where('user_id', auth()->user()->id)->get();
        $equipemembros = Membrosequipe::paginate(10);

        return view('listas.equipemembros_list', compact('equipemembros'));
    }

    public function create() {

        // indica inclusão
        $acao = 1;

        $users = User::orderBy('name')->get();
        $equipes = Equipe::orderBy('nome')->get();

        return view('formularios.equipemembros_form', compact('acao', 'users', 'equipes'));
    }

    public function store(Request $request) {

        // recupera todos os campos do formulário
        $dados = $request->all();
        // insere os dados na tabela
        $car = Membrosequipe::create($dados);

        if ($car) {
            return redirect()->route('equipes.index')
                            ->with('status', $request->sigla . ' Incluído!');
        }
    }

    public function show($id) {
        
    }

    public function edit($id) {

        // obtém os dados do registro a ser editado 
        $reg = Area::find($id);

        // indica ao form que será alteração
        $acao = 2;

        $users = User::orderBy('name')->get();
        return view('formularios.area_form', compact('reg', 'acao', 'users'));
    }

    public function update(Request $request, $id) {

        $reg = Area::find($id);

        $dados = $request->all();
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('areas.index')
                            ->with('status', $request->sigla . ' Alterado!');
        }
    }

    public function destroy($id) {
        $area = Area::find($id);
        if ($area->delete()) {
            return redirect()->route('areas.index')
                            ->with('status', $area->sigla . ' Excluído!');
        }
    }

    public function pesq() {

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
