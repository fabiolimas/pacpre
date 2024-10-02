<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cartao;
use App\Models\Pacote;
use App\Models\Cliente;
use App\Models\Servico;
use App\Models\Historico;
use Illuminate\Http\Request;
use App\Models\PacotesCliente;
use Illuminate\Support\Facades\DB;

class PdvController extends Controller
{
    public function index(){


        $cartoes=Cartao::where('loja_id', auth()->user()->loja_id);
        $vendas = Venda::paginate(20);
        return view('pdv.index', compact('cartoes', 'vendas'));
    }

    public function vendaCartao(){



            $clientes=Cliente::all();









        return view('pdv.vender_cartao', compact('clientes'));
    }

    public function buscaCartaoVendido(Request $request){

        $busca=$request->pesquisa;

        $servicos=Servico::all();

        if($busca==''){


            $pacotes=PacotesCliente::join('pacotes','pacotes.id','pacotes_clientes.pacote_id')
            ->select('pacotes.descricao','pacotes.valor','pacotes.quantidade as qtd', 'pacotes_clientes.*')


            ->where('cliente_id', $busca)


            ->orderBy('pacotes_clientes.id','asc')
            ->paginate(30);



        }else{



               $pacotes=PacotesCliente::join('pacotes','pacotes.id','pacotes_clientes.pacote_id')
               ->select('pacotes.descricao','pacotes.valor','pacotes.quantidade as qtd', 'pacotes_clientes.*')


               ->where('cliente_id', $busca)


               ->orderBy('pacotes_clientes.id','asc')
               ->paginate(30);


           }


        if($pacotes->count() >=1){
            return view('buscas.busca_cartao_vendido',compact('pacotes','servicos'));
        }else{
            return response()->json(['status'=>'Cliente não possui nenhum pacote']);
        }
    }

    public function baixarPontos(Request $request){



        $pacote=PacotesCliente::find($request->id);

        $pac=Pacote::find($pacote->pacote_id);

        if($pac->servico_id == $request->servico_id){




        $baixar=$request->quantidade;
        $quantidade_atual=$pacote->quantidade;
        $usado=$pacote->usado;

        if($usado == null){
            $usado=0;
        }

        if($quantidade_atual < $baixar){

            return redirect()->back()->with('error','Cartão não possui crédito suficiente');

        }else{



            $pacote->update(['usado'=>$usado+=$baixar]);
            $pacote->update([ 'saldo'=>$quantidade_atual-$usado]);

            $historico= new Historico();

            $historico->pacotes_clientes_id=$pacote->id;
            $historico->descricao=$request->descricao;
            $historico->quantidade=$baixar;

            $historico->save();



            return redirect()->back()->withSuccess('Creditos baixados com sucesso');
            // return response()->json(['success'=>'Creditos baixados com sucesso']);

        }

    }else{

        return redirect()->back()->withError('Esse serviço não pertençe a este pacote');
    }





    }
    public function historico(Request $request){
        DB::statement("SET sql_mode = '' ");

        $historicos=Historico::join('pacotes_clientes','pacotes_clientes.id','historicos.pacotes_clientes_id')
        ->select('historicos.*', 'pacotes_clientes.saldo')
        ->where('pacotes_clientes_id',$request->id)

        ->get();
        $total=0;
        $cartao=PacotesCliente::join('pacotes','pacotes.id','pacotes_clientes.pacote_id')
        ->select('pacotes_clientes.*','pacotes.descricao')
        ->find($request->id);



        return view('pdv.historico_cartao',compact('historicos','cartao','total'));

    }

}
