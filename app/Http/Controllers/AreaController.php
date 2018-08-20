<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Area;
use App\User;

class AreaController extends Controller {

    public function index() {

        if (!Auth::check()) {
            return redirect('/');
        }

        //$areas = Area::where('user_id', auth()->user()->id)->get();
        $areas = Area::paginate(10);

        return view('listas.area_list', compact('areas'));
    }

    public function create() {

        if (!Auth::check()) {
            return redirect('/');
        }

        // indica inclusão
        $acao = 1;

        $users = User::orderBy('name')->get();

        return view('formularios.area_form', compact('acao', 'users'));
    }

    public function store(Request $request) {

        if (!Auth::check()) {
            return redirect('/');
        }

        $area = new Area;
        $area->sigla = $request->sigla;
        $area->descricao = $request->descricao;
        $area->user_id = \Illuminate\Support\Facades\Auth::id();
        $area->save();

        if ($area) {
            return redirect()->route('areas.index')
                            ->with('status', $request->sigla . ' Incluído!');
        }
    }

    public function show($id) {
        
    }

    public function edit($id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        // obtém os dados do registro a ser editado 
        $reg = Area::find($id);

        /* if (Gate::denies('Atu_Area', $reg)) {
          abort(403, 'Não autorizado');
          }
         */

        // indica ao form que será alteração
        $acao = 2;

        $users = User::orderBy('name')->get();
        return view('formularios.area_form', compact('reg', 'acao', 'users'));
    }

    public function update(Request $request, $id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = Area::find($id);

        /*
          if (Gate::denies('Atu_Area', $reg)) {
          abort(403, 'Não autorizado');
          }
         */

        $dados = $request->all();
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('areas.index')
                            ->with('status', $request->sigla . ' Alterado!');
        }
    }

    public function destroy($id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        $area = Area::find($id);
        if ($area->delete()) {
            return redirect()->route('areas.index')
                            ->with('status', $area->sigla . ' Excluído!');
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
