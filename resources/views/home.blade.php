@extends('layouts.app')
@section('title', 'Gráficos')
@section('content')
    <div class="">
        <div class="row gy-4 graficos">
             <!-- ApexCharts JS -->
            <!-- Faturamento -->
            {{-- <div class="col-12 col-lg-4 col-xl-5">
                <div class="card">
                    <div class="card-body px-4 py-4">

                        <div class="d-flex justify-content-between gap-3 align-items-center">
                            <h2 class="fs-24px fw-600 text-green-2 ">Faturamento</h2>
                            <div class="">
                                <form method="GET" action="#">
                                    <div class="row mb-4">
                                        <div class="col-md-5">
                                            <label for="data_inicio">Data Inicial:</label>
                                            <input type="date" name="data_inicio" class="form-control" value="{{ $dataInicio }}">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="data_fim">Data Final:</label>
                                            <input type="date" name="data_fim" class="form-control" value="{{ $dataFim }}">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary"> <i data-feather="search"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                        {!! $cartoesGerados->container() !!}

                        <div class="line-chart mt-4 pt-3 position-relative pb-3">
                            <div class="line-chart-vertical"></div>
                            <div class="position-absolute d-flex w-100 justify-content-between">
                                <div class="line-chart-dot line-chart-dot-1"></div>
                                <div class="line-chart-dot line-chart-dot-2"></div>
                                <div class="line-chart-dot line-chart-dot-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Quantidade de cartões vendidos -->
            @canany(['admin','loja'])
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-body px-4 py-4">

                        <div class="d-md-flex align-items-center justify-content-between gap-3">
                            <h2 class="fs-24px fw-600 text-green-2 ">Cartões Vendidos</h2>
                            <div class="d-flex gap-2">
                                <div class="">

                                </div>
                                <form method="GET" action="#">
                                    <div class="row mb-4">
                                        <div class="col-md-5">
                                            <label for="data_inicio">Data Inicial:</label>
                                            <input type="date" name="data_inicio" class="form-control" value="{{ $dataInicio }}">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="data_fim">Data Final:</label>
                                            <input type="date" name="data_fim" class="form-control" value="{{ $dataFim }}">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary"> <i data-feather="search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="">

                                </div>
                            </div>
                        </div>
                        <div id="graficoCartoesVendidos">
                        {!! $graficoCartoesVendidos->container() !!}
                    </div>


                        <div class="line-chart mt-4 pt-3 position-relative pb-3">
                            <div class="line-chart-vertical"></div>
                            <div class="position-absolute d-flex w-100 justify-content-between">
                                <div class="line-chart-dot line-chart-dot-1"></div>
                                <div class="line-chart-dot line-chart-dot-2"></div>
                                <div class="line-chart-dot line-chart-dot-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-body px-4 py-4">

                        <div class="d-md-flex align-items-center justify-content-between gap-3">
                            <h2 class="fs-24px fw-600 text-green-2 ">Vendas por loja</h2>
                        </div>

                        <div class="table-responsive mt-5">
                            <table class="table text-green-2 resultBusca">
                                <thead>
                                    <tr class="fs-18px ">
                                        <th scope="col"><span
                                                class="text-green-2 d-inline-block pb-3">Loja</span></th>
                                        <th scope="col"><span
                                                class="text-green-2 d-inline-block pb-3">Total</span></th>
                                        <th scope="col"><span class="text-green-2 d-inline-block pb-3">Vendas
                                                </span>
                                        </th>




                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($vendas as $venda)

                                    @php
                                        $totalValor+=$venda->valor_total;
                                        $totalQuantidade+=$venda->quantidade_total;
                                    @endphp
                                        <tr class=" table-tr-cliente fw-500 fs-18px "
                                            style="cursor:pointer">
                                            <td class="text-green">
                                                <span class="text-green">

                                                    {{ $venda->nfantasia }}</span>
                                            </td>



                                            <td>
                                                <span class="text-green">R$
                                                    {{ number_format($venda->valor_total, 2, ',', '.') }}</span>
                                            </td>

                                            <td>
                                                <span class="text-green">{{ $venda->quantidade_total }}</span>
                                            </td>



                                        </tr>



                                    @endforeach
                                    @if($vendas->count() !=0)
                                    <tr class=" table-tr-cliente fw-500 fs-18px "
                                    style="cursor:pointer">
                                        <th>Total</th>
                                        <td><span class="text-green">R$ {{number_format($totalValor,2,',','.')}}</span></td>
                                        <td><span class="text-green">{{$totalQuantidade}}</span></td>

                                    </tr>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{route('relatorio.vendas')}}" class="btn btn-primary">Vendas</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- {{dd($graficoCartoesVendidos->script())}} --}}
            @endcanany






    </div>

    @canany(['admin','loja'])
    <!-- scripts apexchart -->
    <script src="{{ $graficoCartoesVendidos->cdn() }}"></script>
    {{-- {{ $cartoesGerados->script() }} --}}
    {{ $graficoCartoesVendidos->script() }}


@endcanany

@endsection

@section('scripts')

@endsection
