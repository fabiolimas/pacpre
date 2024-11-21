<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use App\Models\Venda;
use App\Models\Cartao;
use App\Models\Pacote;
use App\Models\Cliente;
use App\Models\PacotesCliente;
use App\Models\Servico;
use Illuminate\Http\Request;

class PacotesController extends Controller
{
   public function index(){


    $pacotes=Pacote::all();
    $clientes=Cliente::all();



    if(auth()->user()->profile == 'cliente'){


        $cliente=Cliente::where('user_id', auth()->user()->id)->first();

        $pacotes=PacotesCliente::join('pacotes','pacotes.id','pacotes_clientes.pacote_id')
        ->select('pacotes_clientes.*','pacotes.descricao','pacotes.quantidade','pacotes.valor')
        ->where('cliente_id', $cliente->id)->paginate(30);

        return view('pacotes.index',compact('pacotes','clientes','cliente'));
    }else{

        return view('pacotes.index',compact('pacotes','clientes'));
    }



   }

   public function create(){

    $servicos=Servico::all();

    return view('pacotes.create',compact('servicos'));
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
    $valor=str_replace(',','.',$request->valor);

        $pacote->update([
            'valor'=>$valor,
            'descricao'=>$request->descricao,
            'quantidade'=>$request->quantidade
        ]);







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

// Venda Pacote


public function venderPacote(Request $request)
{


    if($request->cliente == '' || $request->cliente == null){

        return redirect()->back()->withError('Selecione um cliente válido');
    }else{


//dd($request);
$valor=$request->qtd_pacotes*$request->valor;

    $venda = new Venda();

    $venda->loja_id = auth()->user()->loja_id;
    $venda->pacote_id = $request->id;
    $venda->valor = $valor;
    $venda->quantidade = $request->qtd_pacotes;
    $venda->status = 'Vendido';
    $venda->cliente_id=$request->cliente;
    $venda->save();


    $i=0;

    if ($request->qtd_pacotes >= 2) {
        for ($i = 0; $i < $request->qtd_pacotes; $i++) {
            $pacoteCliente = new PacotesCliente();
            $pacoteCliente->cliente_id = $request->cliente;
            $pacoteCliente->pacote_id = $request->id;
            $pacoteCliente->quantidade = $request->quantidade;
            $pacoteCliente->venda_id=$venda->id;
            $pacoteCliente->save();
        }
    } else {
        $pacoteCliente = new PacotesCliente();
        $pacoteCliente->cliente_id = $request->cliente;
        $pacoteCliente->pacote_id = $request->id;
        $pacoteCliente->quantidade = $request->quantidade;
        $pacoteCliente->venda_id=$venda->id;
        $pacoteCliente->save();
    }






    return redirect()->back()->withSuccess('Pacote vendido com sucesso');
    }
}
}
