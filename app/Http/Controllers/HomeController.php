<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $dataInicio = $request->input('data_inicio', '2024-01-01'); // Padrão: 1º de Janeiro de 2024
        $dataFim = $request->input('data_fim', now()->format('Y-m-d')); // Padrão: Data atual

        $cartoesGerados = (new LarapexChart)->barChart()
            ->setHorizontal(false) // Gráfico de barras vertical
            ->setXAxis(['Jacobina', 'Juazeiro', 'Petrolina']) // Definir os clientes como rótulos do eixo X
            ->setDataset([[
                'name'  =>  'Faturamento',
                'data'  =>  ['200', '30', '150'] // Definir o faturamento como dados do gráfico
            ]])
            ->setColors(['#0E6664']) // Cor das barras
            ->setSparkline()
            ->setHeight(315); // Altura do gráfico

        if (auth()->user()->profile == 'admin') {

            // Consulta para obter o total de cartões vendidos por loja
            $cartoesVendidos = Venda::where('status', 'Vendido')
                ->whereBetween('created_at', [$dataInicio, $dataFim])
                ->groupBy('loja_id')
                ->select('loja_id', DB::raw('COUNT(*) as total_cartoes'))
                ->get();

            // Obtenha os rótulos (nomes das lojas) e os dados (total de cartões vendidos)
            $labels = [];
            $dataset = [];

            foreach ($cartoesVendidos as $venda) {
                $loja = Loja::find($venda->loja_id); // Busque o nome da loja pelo ID
                $labels[] = $loja->nfantasia; // Adicione o nome da loja nos rótulos
                $dataset[] = $venda->total_cartoes; // Adicione o total de cartões vendidos ao dataset
            }

            // Criar o gráfico do tipo PieChart
            $graficoCartoesVendidos = (new LarapexChart)->pieChart()
                ->setLabels($labels) // Definir os nomes das lojas como rótulos
                ->setDataset($dataset) // Definir o total de cartões vendidos por loja como dataset
                ->setColors(['#0E6664', '#FF4560', '#775DD0', '#00E396']) // Definir cores diferentes para as fatias
                ->setHeight(315); // Altura do gráfico


        } else {

            $cartoesVendidos = Venda::where('loja_id', auth()->user()->loja_id)
                ->where('status', 'Vendido')
                ->whereBetween('created_at', [$dataInicio, $dataFim])
                ->select(DB::raw('COUNT(*) as total_cartoes')) // Contar o total de cartões vendidos
                ->first();

            $loja = Loja::find(auth()->user()->loja_id);

            $labels = [$loja->nfantasia]; // Definir o nome da loja como rótulo do gráfico

            $dataset = [$cartoesVendidos->total_cartoes]; // Pegar o total de cartões vendidos

            $graficoCartoesVendidos = (new LarapexChart)->pieChart()
                ->setLabels($labels) // Definir o nome da loja como rótulo
                ->setDataset($dataset) // Definir o total de cartões vendidos como dataset
                ->setColors(['#0E6664']) // Cor das fatias do gráfico
                ->setHeight(315); // Altura do gráfico

        }






        return view('home', compact('dataInicio', 'dataFim', 'cartoesGerados', 'cartoesVendidos', 'graficoCartoesVendidos'));
    }
}
