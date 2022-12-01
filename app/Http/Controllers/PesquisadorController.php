<?php

namespace App\Http\Controllers;

use App\Models\Pesquisador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;
use App\Models\User;
use TCG\Voyager\Models\Role;

class PesquisadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('browse', new Pesquisador)){
            $pesquisadores = Pesquisador::paginate();
            return view('pesquisadores.index', compact('pesquisadores'));
          } else {
          $pesquisadores = Pesquisador::where('usuario_id', Auth::user()->id)->paginate();
          return view('pesquisadores.index', compact('pesquisadores'));
          }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        return view('pesquisadores.solicitar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() === true ) {
            $pesquisador = new Pesquisador();
            $pesquisador->email_institucional = $request->email_institucional;
            $pesquisador->curriculo_lattes = $request->curriculo_lattes;
            $pesquisador->usuario_id = Auth::user()->id;
            $pesquisador->situacao = 0; // 0 = solicitado aprovação
           $pesquisador->save();
            return redirect()->route('pesquisador.index');
        } else {
            $request->session()->flash('mensagem', 'Você não possui permissão para isso');
            return redirect()->route('pesquisador.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function search(Request $request)
    {
        if (empty($request->search)){
          $pesquisadores = Pesquisador::paginate();
          return view('pesquisadores.index', compact('pesquisadores'));
        } else {
        $pesquisadores = Pesquisador::where('email_institucional', $request->search)->paginate();
        return view('pesquisadores.index', compact('pesquisadores'));
        }

    }

    public function aprovar(Request $request)
    {
        $pesquisador = Pesquisador::find($request->pesquisador_id);
        $pesquisador->situacao = 1;
        $pesquisador->save();
        $usuario = User::find($pesquisador->usuario_id);
        $role = Role::where('name', 'pesquisador')->firstOrFail();
        $usuario->role_id = $role->id;
        $usuario->save();
        if (Auth::user()->can('edit', new Pesquisador)){
            $pesquisadores = Pesquisador::paginate();
            return view('pesquisadores.avaliar', compact('pesquisadores'));
          }else{
        return redirect()->route('pesquisador.index');
        }
    }
    public function negar(Request $request)
    {

        $pesquisador = Pesquisador::find($request->pesquisador_id);
        $pesquisador->situacao = 2;
        $pesquisador->justificativa = $request->justificativa;
        $pesquisador->save();
        if (Auth::user()->can('edit', new Pesquisador)){
            $pesquisadores = Pesquisador::paginate();
            return view('pesquisadores.avaliar', compact('pesquisadores'));
          }else{

        return redirect()->route('pesquisador.index');
          }
    }

    public function solicitacoes(Request $request)
    {
        if (Auth::check() === true ) {
            $pesquisadores = Pesquisador::paginate();
            return view('pesquisadores.solicitacoes', compact('pesquisadores'));
        } else {
            $request->session()->flash('mensagem', 'Você não possui permissão para isso');
            return redirect()->route('pesquisador.index');
        }
    }
    public function avaliar()
    {
        //if (Auth::user()->can('edit', new Pesquisador)){
            $pesquisadores = Pesquisador::paginate();
            return view('pesquisadores.avaliar', compact('pesquisadores'));
          /*} else {
          $pesquisadores = Pesquisador::where('usuario_id', Auth::user()->id)->paginate();
          return view('pesquisadores.index', compact('pesquisadores'));
           }
           */

    }

}
