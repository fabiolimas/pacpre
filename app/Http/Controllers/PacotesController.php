<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use App\Models\Cartao;
use App\Models\Pacote;
use App\Models\Servico;
use Illuminate\Http\Request;

class PacotesController extends Controller
{
   public function index(){


    $pacotes=Pacote::all();

    return view('pacotes.index',compact('pacotes'));
   }

   public function create(){

    return view('pacotes.create');
   }

   public function store(Request $request){

    $pacote=new Pacote();


    $pacote->fill($request->all());
    $pacote->status='ativo';
$pacote->valor=str_replace(',','.',$request->valor);
    $pacote->save();

    return redirect()->route('pacotes.index')->withSuccess('Pacote cadastrado com sucesso');

   }

   public function update(Request $request){

    $pacote=Pacote::find($request->id);

    $pacote->update($request->all());



    return redirect()->back()->withSuccess('Pacote editado com sucesso');
   }




   public function buscaPacote(Request $request){

    $busca=$request->pesquisa;

    if($busca==''){

        $pacotes=Pacote::all();


    }else{
        $pacotes=Pacote::where('descricao', 'like', '%'.$busca.'%')->get();
    }





    if($pacotes->count() >=1){
        return view('buscas.busca_pacote',compact('pacotes'));
    }else{
        return response()->json(['status'=>'Pacote não encontrado']);
    }
}

/*Gerador de cartõ<es>*/

public function geraCartoes(){

    $lojas=Loja::all();
    $pacotes=Pacote::all();
    $servicos=Servico::all();

    return view('pacotes.gera_numeracao', compact('lojas', 'pacotes', 'servicos'));
}

public function storeCartoes(Request $request){



    $pacote=Pacote::find($request->pacote_id);

$i=0;
$numero=0;
for($i=$request->num_inicio;$i<=$request->num_fim;$i++){

    $cartoes=Cartao::where('numero',$i)
    ->where('loja_id', $request->loja_id)->count();
    if($cartoes !=0){

        return redirect()->back()->with('error','Essa numeração ja existe!');

    }else{
        $cartao= new Cartao();
        $cartao->loja_id=$request->loja_id;
        $cartao->pacote_id=$request->pacote_id;
        $cartao->servico_id=$request->servico_id;
        $cartao->numero=$i;
        $cartao->quantidade= $pacote->quantidade;
        $cartao->valor=$pacote->valor;
        $cartao->status='Aberto';
        $cartao->save();

    }


}
return redirect()->back()->withSuccess('Cartões gerados com Sucesso');


}
}
