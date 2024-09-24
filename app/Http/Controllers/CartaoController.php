<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cartao;
use Illuminate\Http\Request;

class CartaoController extends Controller
{
    public function index()
    {


        if (auth()->user()->profile == 'admin') {

            $cartoes = Cartao::join('pacotes', 'pacotes.id', 'cartaos.pacote_id')
            ->join('lojas','lojas.id','cartaos.loja_id')
            ->select('pacotes.descricao', 'cartaos.*','lojas.nfantasia')
            ->paginate(30);

        } else {

            $cartoes = Cartao::join('pacotes', 'pacotes.id', 'cartaos.pacote_id')
                ->select('pacotes.descricao', 'cartaos.*')

                ->where('cartaos.loja_id', auth()->user()->loja_id)
                ->where('cartaos.status', 'Aberto')
                ->orderBy('cartaos.id', 'asc')
                ->paginate(30);
        }




        return view('cartoes.index', compact('cartoes'));
    }

    public function create()
    {

        return view('cartoes.create');
    }




    public function buscaCartao(Request $request)
    {


        $busca = $request->pesquisa;

        if ($busca == '') {
            if (auth()->user()->profile == 'admin') {
                $cartoes = Cartao::join('pacotes', 'pacotes.id', 'cartaos.pacote_id')
                ->join('lojas','lojas.id','cartaos.loja_id')
                    ->select('pacotes.descricao', 'cartaos.*','lojas.nfantasia')->paginate(30);

            }else{
                $cartoes = Cartao::join('pacotes', 'pacotes.id', 'cartaos.pacote_id')
                ->join('lojas', 'lojas.id', 'cartaos.loja_id')
                ->select('pacotes.descricao', 'cartaos.*')
                ->where('cartaos.loja_id', auth()->user()->loja_id) // Restringe à loja logada
                ->where(function ($query) use ($busca) {
                    $query->orWhere('numero', 'like', '%' . $busca . '%')
                          ->orWhere('pacotes.descricao', 'like', '%' . $busca . '%');
                })
                ->where('cartaos.status', 'Aberto') // Verifica o status do cartão
                ->orderBy('cartaos.id', 'asc')
                ->paginate(30);




            }




        } else {

            if (auth()->user()->profile == 'admin') {
                $cartoes = Cartao::join('pacotes', 'pacotes.id', 'cartaos.pacote_id')
                ->join('lojas','lojas.id','cartaos.loja_id')
                    ->select('pacotes.descricao', 'cartaos.*','lojas.nfantasia')
                    ->where('numero', 'like', '%' . $busca . '%')
                    ->orWhere('descricao', 'like', '%' . $busca . '%')
                    ->orWhere('nfantasia', 'like', '%' . $busca . '%')
                    ->where('cartaos.status', 'Aberto')
                    ->orderBy('cartaos.id', 'asc')
                    ->paginate(30);
            } else {

                $cartoes = Cartao::join('pacotes', 'pacotes.id', 'cartaos.pacote_id')
                ->join('lojas', 'lojas.id', 'cartaos.loja_id')
                ->select('pacotes.descricao', 'cartaos.*')
                ->where('cartaos.loja_id', auth()->user()->loja_id) // Restringe à loja logada
                ->where(function ($query) use ($busca) {
                    $query->Where('numero', 'like', '%' . $busca . '%')
                          ->orWhere('pacotes.descricao', 'like', '%' . $busca . '%');
                })
                ->where('cartaos.status', 'Aberto') // Verifica o status do cartão
                ->orderBy('cartaos.id', 'asc')
                ->paginate(30);


            }
        }





        if ($cartoes->count() >= 1) {
            return view('buscas.busca_cartao', compact('cartoes'));
        } else {
            return response()->json(['status' => 'Cartão não encontrado']);
        }
    }


    public function venderCartao(Request $request)
    {


        $venda = new Venda();

        $venda->loja_id = auth()->user()->loja_id;
        $venda->cartao_id = $request->id;
        $venda->valor = $request->valor;
        $venda->status = 'Vendido';
        $venda->save();

        $cartao = Cartao::find($request->id);
        $cartao->update(['status' => 'Vendido']);

        return redirect()->back()->withSuccess('Cartão vendido com sucesso');
    }


}
