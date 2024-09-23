<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cartao;
use App\Models\Historico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdvController extends Controller
{
    public function index(){


        $cartoes=Cartao::where('loja_id', auth()->user()->loja_id);
        $vendas = Venda::paginate(20);
        return view('pdv.index', compact('cartoes', 'vendas'));
    }

    public function vendaCartao(){

        if(auth()->user()->profile=='admin'){

            $cartoes=Cartao::join('pacotes','pacotes.id','cartaos.pacote_id')->paginate(30);


        }else{

            $cartoes=Cartao::join('pacotes','pacotes.id','cartaos.pacote_id')

            ->select('pacotes.descricao', 'cartaos.*')

            ->where('loja_id',auth()->user()->loja_id)
            ->where('cartaos.status','Vendido')
            ->orderBy('cartaos.id','asc')
            ->paginate(30);



        }




        return view('pdv.vender_cartao', compact('cartoes'));
    }

    public function buscaCartaoVendido(Request $request){

        $busca=$request->pesquisa;

        if($busca==''){

            $cartoes=Cartao::join('pacotes','pacotes.id','cartaos.pacote_id')
            ->select('pacotes.descricao', 'cartaos.*')

            ->where('loja_id', auth()->user()->loja_id)
            ->where('cartaos.status','Vendido')

           ->paginate(30);


        }else{

           if(auth()->user()->profile='admin'){
               $cartoes=Cartao::join('pacotes','pacotes.id','cartaos.pacote_id')
               ->select('pacotes.descricao', 'cartaos.*')
               ->where('cartaos.status','Vendido')
               ->where('numero', 'like', '%'.$busca.'%')
               ->where('descricao', 'like', '%'.$busca.'%')

               ->orderBy('cartaos.id','asc')
               ->paginate(30);

           }else{

               $cartoes=Cartao::join('pacotes','pacotes.id','cartaos.pacote_id')
               ->select('pacotes.descricao', 'cartaos.*')
               ->where('loja_id', auth()->user()->loja_id)
               ->where('cartaos.status','Vendido')
               ->where('numero', 'like', '%'.$busca.'%')
               ->where('descricao', 'like', '%'.$busca.'%')

               ->orderBy('cartaos.id','asc')
               ->paginate(30);
           }




        }





        if($cartoes->count() >=1){
            return view('buscas.busca_cartao_vendido',compact('cartoes'));
        }else{
            return response()->json(['status'=>'Cartão não encontrado']);
        }
    }

    public function baixarPontos(Request $request){

        $cartao=Cartao::find($request->id);
        $baixar=$request->quantidade;
        $quantidade_atual=$cartao->quantidade;

        if($quantidade_atual < $baixar){


            return redirect()->back()->with('error','Cartão não possui crédito suficiente');
        }else{



            $cartao->update(['quantidade'=>$quantidade_atual-=$baixar]);

            $historico= new Historico();

            $historico->cartao_id=$request->id;
            $historico->descricao=$request->descricao;
            $historico->quantidade=$baixar;

            $historico->save();



            return redirect()->back()->withSuccess('Creditos baixados com sucesso');

        }





    }
    public function historico(Request $request){
        DB::statement("SET sql_mode = '' ");

        $historicos=Historico::join('cartaos','cartaos.id','historicos.cartao_id')
        ->select('historicos.*', 'cartaos.quantidade as saldo')
        ->where('cartao_id',$request->id)

        ->get();
        $total=0;
        $cartao=Cartao::join('pacotes', 'pacotes.id','cartaos.pacote_id')
        ->select('pacotes.descricao', 'cartaos.*')

        ->find($request->id);

        return view('pdv.historico_cartao',compact('historicos','cartao','total'));

    }

}
