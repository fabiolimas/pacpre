<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index(){


     $servicos=Servico::all();

     return view('servicos.index',compact('servicos'));
    }

    public function create(){

     return view('servicos.create');
    }

    public function store(Request $request){

     $servico=new Servico();


     $servico->fill($request->all());
     $servico->status='ativo';

     $servico->save();

     return redirect()->route('servicos.index')->withSuccess('Serviço cadastrado com sucesso');

    }

    public function update(Request $request){

     $servico=Servico::find($request->id);

     $servico->update($request->all());



     return redirect()->back()->withSuccess('Servico editado com sucesso');
    }




    public function buscaServico(Request $request){

     $busca=$request->pesquisa;

     if($busca==''){

         $servicos=Servico::all();


     }else{
         $servicos=Servico::where('descricao', 'like', '%'.$busca.'%')->get();
     }





     if($servicos->count() >=1){
         return view('buscas.busca_servico',compact('servicos'));
     }else{
         return response()->json(['status'=>'Servico não encontrado']);
     }
 }
 }
