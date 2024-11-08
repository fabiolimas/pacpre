@extends('layouts.app')
@section('title', 'Vendas')
@section('content')
    <div class="">
        <div class="row gy-4 graficos">


            <!-- Quantidade de cartões vendidos -->
            @canany(['admin', 'loja'])
                <div class="col-12 col-lg-8 col-xl-12">
                    <div class="card">
                        <div class="card-body px-4 py-4">

                            <div class="d-md-flex align-items-center justify-content-between gap-3">
                                <h2 class="fs-24px fw-600 text-green-2 ">Vendas</h2>
                                <div class="d-flex gap-2">
                                    <div class="">

                                    </div>
                                    <form method="post" action="{{route('relatorio.vendas_pdf')}}">
                                        @csrf
                                        <div class="row mb-4">
                                            <div class="col-md-3">
                                                <label for="data_inicio">Data Inicial:</label>
                                                <input type="date" name="data_inicio" class="form-control"
                                                    value="{{ $dataInicio }}" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="data_fim">Data Final:</label>
                                                <input type="date" name="data_fim" class="form-control"
                                                    value="{{ $dataFim }}" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="loja">Loja:</label>
                                               <select class="form-select" name="loja" id="loja" required>
                                                <option value>Selecione a loja</option>
                                                @foreach($lojas as $loja)

                                                    <option value="{{$loja->id}}">{{$loja->nfantasia}}</option>
                                                @endforeach
                                               </select>
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary"> <i
                                                        data-feather="search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="">

                                    </div>
                                </div>
                            </div>


                        </div>


                        {{-- <div class="table-responsive mt-5">
                            <table class="table text-green-2 resultBusca">
                                <thead>
                                    <tr class="fs-18px ">
                                        <th scope="col"><span class="text-green-2 d-inline-block pb-3">Loja</span></th>
                                        <th scope="col"><span class="text-green-2 d-inline-block pb-3">Total</span></th>
                                        <th scope="col"><span class="text-green-2 d-inline-block pb-3">Vendas
                                            </span>
                                        </th>




                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendas as $venda)
                                        <tr class=" table-tr-cliente fw-500 fs-18px " style="cursor:pointer">
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
                                </tbody>
                            </table>

                        </div> --}}
                    </div>
                </div>


            @endcanany






        </div>



    @endsection

