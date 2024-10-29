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
            <div class="col-12 col-lg-8 col-xl-12">
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
