<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use App\Models\Venda;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class RelatoriosController extends Controller
{
  public function vendas(Request $request){

    $dataInicio = $request->input('data_inicio', '2024-01-01'); // Padrão: 1º de Janeiro de 2024
    $dataFim = $request->input('data_fim', now()->addDay()->format('Y-m-d')); // Padrão: Data atual

    $lojas=Loja::all();




    return view('relatorios.vendas',compact('dataInicio','dataFim','lojas'));

  }

  public function relVendas(Request $request){

 $dataInicio = $request->input('data_inicio');
    $dataFim = $request->input('data_fim');
    $loja_id=$request->loja;
    $loja=Loja::Find($loja_id);

$total=0;
    $vendas = Venda::join('lojas', 'lojas.id', '=', 'vendas.loja_id')
    ->join('clientes','clientes.id','vendas.cliente_id')
    ->join('pacotes','pacotes.id','vendas.pacote_id')
    ->select('lojas.nfantasia', 'pacotes.descricao','clientes.nome','vendas.created_at','vendas.valor')
    ->where('vendas.status', 'Vendido')
    ->where('lojas.id',$loja_id)
    ->whereBetween('vendas.created_at', [$dataInicio, $dataFim])

    ->get();

    //dd($loja);

    //return view('relatorios.vendas_pdf',compact('vendas','dataInicio','dataFim','loja','total'));

    // $pdf = PDF::loadView('relatorios.vendas_pdf', compact('vendas','dataInicio','dataFim','loja','total'));

    // return $pdf->stream();

    $pdf = PDF::loadView('relatorios.vendas_pdf', compact('vendas','dataInicio','dataFim','loja','total'))->setOptions(['enable_remote' => true]);

    return $pdf->stream();


  }
}
