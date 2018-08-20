<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Fluxo;

class FluxoController extends Controller {

    public function index() {

        if (!Auth::check()) {
            return redirect('/');
        }

        //$areas = Area::where('user_id', auth()->user()->id)->get();
        $fluxos = Fluxo::paginate(10);

        return view('listas.fluxo_list', compact('fluxos'));
    }

    public function create() {

        if (!Auth::check()) {
            return redirect('/');
        }

        // indica inclusão
        $acao = 1;

        return view('formularios.fluxo_form', compact('acao'));
    }

    public function store(Request $request) {

        if (!Auth::check()) {
            return redirect('/');
        }

        // recupera todos os campos do formulário
        $dados = $request->all();
        // insere os dados na tabela
        $car = Fluxo::create($dados);
        if ($car) {
            return redirect()->route('fluxos.index')
                            ->with('status', $request->descricao . ' Incluído!');
        }
    }

    public function show($id) {
        
    }

    public function edit($id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        // obtém os dados do registro a ser editado 
        $reg = Fluxo::find($id);

        /* if (Gate::denies('Atu_Area', $reg)) {
          abort(403, 'Não autorizado');
          }
         */

        // indica ao form que será alteração
        $acao = 2;

        return view('formularios.fluxo_form', compact('reg', 'acao'));
    }

    public function update(Request $request, $id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        $reg = Fluxo::find($id);

        /*
          if (Gate::denies('Atu_Area', $reg)) {
          abort(403, 'Não autorizado');
          }
         */

        $dados = $request->all();
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('fluxos.index')
                            ->with('status', $request->descricao . ' Alterado!');
        }
    }

    public function destroy($id) {

        if (!Auth::check()) {
            return redirect('/');
        }

        $fluxo = Fluxo::find($id);
        if ($fluxo->delete()) {
            return redirect()->route('fluxos.index')
                            ->with('status', $fluxo->descricao . ' Excluído!');
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
