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

        $cpf=str_replace( array( '-', '.' ), '',  $request->pesquisacpf);

        $buscacpf=$cpf;

        $cliente=Cliente::find($buscacpf);

        $servicos=Servico::all();

        if($buscacpf == ''){


            $pacotes=PacotesCliente::join('pacotes','pacotes.id','pacotes_clientes.pacote_id')
            ->join('clientes','clientes.id','pacotes_clientes.cliente_id')
            ->select(
                'pacotes.descricao',
                'pacotes.valor',
                'pacotes.quantidade as qtd',
                 'pacotes_clientes.*',
                 'clientes.cpf','clientes.nome')


            // ->where('cliente_id', $busca)
            ->Where('clientes.cpf',$buscacpf)

            ->orderBy('pacotes_clientes.id','asc')
            ->paginate(30);



        }else{



               $pacotes=PacotesCliente::join('pacotes','pacotes.id','pacotes_clientes.pacote_id')
               ->join('clientes','clientes.id','pacotes_clientes.cliente_id')
               ->select(
                'pacotes.descricao',
                'pacotes.valor',
                'pacotes.quantidade as qtd',
                 'pacotes_clientes.*',
                 'clientes.cpf','clientes.nome')

            //    ->where('cliente_id', $busca)
               ->Where('clientes.cpf',$buscacpf)

               ->orderBy('pacotes_clientes.id','asc')
               ->paginate(30);



           }

           $cliente=Cliente::where('cpf', $buscacpf)->first();
        if($pacotes->count() >=1){
            return view('buscas.busca_cartao_vendido',compact('pacotes','servicos','cliente'));
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
        $saldo=$pacote->saldo;

        if($usado == null){
            $usado=0;
        }

        if($saldo== null){
            $saldo=$quantidade_atual;
        }



        if($baixar > $saldo){

            //return redirect()->back()->with('error','Cartão não possui crédito suficiente');
            return response()->json(['status'=>'Este serviço não pertence a este pacote']);

        }else{



            $pacote->update(['usado'=>$usado+=$baixar]);
            $pacote->update([ 'saldo'=>$quantidade_atual-$usado]);

            $historico= new Historico();

            $historico->pacotes_clientes_id=$pacote->id;
            $historico->descricao=$request->descricao;
            $historico->quantidade=$baixar;

            $historico->save();



          //return redirect()->back()->withSuccess('Creditos baixados com sucesso');
            return response()->json(['success'=>'Creditos baixados com sucesso']);

        }


    }else{

        // return redirect()->back()->withError('Esse serviço não pertençe a este pacote');
        return response()->json(['status'=>'Este serviço não pertence a este pacote']);
    }





    }
    public function historico(Request $request){
        DB::statement("SET sql_mode = '' ");

        $historicos=Historico::join('pacotes_clientes','pacotes_clientes.id','historicos.pacotes_clientes_id')
        ->select('historicos.*', 'pacotes_clientes.saldo')
        ->where('pacotes_clientes_id',$request->pacote)

        ->get();

        $cliente=Cliente::find($request->cliente);


        $total=0;
        $cartao=PacotesCliente::join('pacotes','pacotes.id','pacotes_clientes.pacote_id')
        ->select('pacotes_clientes.*','pacotes.descricao')
        ->find($request->pacote);







        return view('pdv.historico_cartao',compact('cliente','historicos','cartao','total'));

    }

}
