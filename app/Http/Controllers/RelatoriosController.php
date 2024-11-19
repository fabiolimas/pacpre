<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Loja;
use App\Models\Venda;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class RelatoriosController extends Controller
{
  public function vendas(Request $request){

    $dataInicio = $request->input('data_inicio', Carbon::now()->firstOfMonth()->format('Y-m-d'));
    $dataFim = $request->input('data_fim', now()->addDay()->format('Y-m-d')); // Padrão: Data atual

    $lojas=Loja::all();




    return view('relatorios.vendas',compact('dataInicio','dataFim','lojas'));

  }

  public function relVendas(Request $request){

    $dataInicio = $request->dataInicial;
    $dataFim = $request->dataFinal;
    $loja_id=$request->loja;
    $loja=Loja::Find($loja_id);


$total=0;
$totalqtd=0;

if($dataInicio === $dataFim){
    $vendas = Venda::join('lojas', 'lojas.id', '=', 'vendas.loja_id')
->join('clientes', 'clientes.id', 'vendas.cliente_id')
->join('pacotes', 'pacotes.id', 'vendas.pacote_id')
->select('lojas.nfantasia', 'pacotes.descricao', 'clientes.nome', 'vendas.created_at', 'vendas.valor','vendas.quantidade')
->where('vendas.status', 'Vendido')
->where('lojas.id', $loja_id)
->where('vendas.created_at', 'like', '%'.$dataInicio.'%')
->get();
}else{
    $vendas = Venda::join('lojas', 'lojas.id', '=', 'vendas.loja_id')
    ->join('clientes', 'clientes.id', 'vendas.cliente_id')
    ->join('pacotes', 'pacotes.id', 'vendas.pacote_id')
    ->select('lojas.nfantasia', 'pacotes.descricao', 'clientes.nome', 'vendas.created_at', 'vendas.valor','vendas.quantidade')
    ->where('vendas.status', 'Vendido')
    ->where('lojas.id', $loja_id)
    ->whereBetween('vendas.created_at', [$dataInicio, $dataFim])
    ->get();

}



//debug

//$pdf = PDF::loadView('relatorios.vendas_pdf', compact('vendas', 'dataInicio', 'dataFim', 'loja', 'total','totalqtd'));

$pdf = PDF::loadView('relatorios.vendas_pdf', compact('vendas', 'dataInicio', 'dataFim', 'loja', 'total','totalqtd'))->setOptions(['enable_remote' => true, 'defaultPaperSize' => "a4"]);

// Salva o PDF temporariamente
$filePath = 'pdfs/temp_relatorio_vendas.pdf';
Storage::disk('public')->put($filePath, $pdf->output());

    // Retorna a URL do PDF
    return response()->json(['url' => Storage::url($filePath)]);


  }
}
