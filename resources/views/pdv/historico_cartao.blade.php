@extends('layouts.app')
@section('title', 'Histórico')

@section('content')


    <div class="">
        <div class="row gy-4">

            <!-- Lista -->
            <div class="col-12">
                <div class="card min-vh-100">
                    <div class="card-body px-2 px-md-4 py-4">



                        <!-- lista -->
                        <div class="mt-2 pt-1 ">
                            <div class="">
                                <div
                                    class="d-sm-flex text-center text-md-start justify-content-between gap-2 align-items-center">
                                    <h1 class="fs-4 fw-600 mb-4 text-green-2">
                                        <i data-feather="credit-cartd"></i> Historico Pacote Foto-Pré
                                    </h1>




                                </div>
                                <div class="row">
                                    <p><b>Pacote:</b> {{ $cartao->descricao }} <b>Saldo:
                                        </b>{{ $cartao->saldo }}</p>
                                </div>

                                <div class="table-responsive mt-5">
                                    <table class="table text-green-2">
                                        <thead>
                                            <tr class="fs-18px ">

                                                <th scope="col"><span
                                                        class="text-green-2 d-inline-block pb-3">Descrição</span></th>
                                                <th scope="col"><span class="text-green-2 d-inline-block pb-3">Quantidade
                                                        de baixada</span>
                                                </th>
                                                {{-- <th scope="col"><span class="text-green-2 d-inline-block pb-3">Quantidade
                                                    de anterior</span>
                                            </th> --}}

                                                <th scope="col"><span
                                                        class="text-green-2 d-inline-block pb-3">Data</span>
                                                </th>




                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($historicos as $historico)
                                                <tr>

                                                    <td>{{ $historico->descricao }}</td>
                                                    <td>{{ $historico->quantidade }}</td>
                                                    {{-- <td>{{$historico->saldo+$historico->quantidade}}</td> --}}

                                                    <td>{{ date('d-m-Y H:i', strtotime($historico->created_at)) }}</td>

                                                </tr>
                                                @php $total+=$historico->quantidade; @endphp
                                            @endforeach
                                            <tr>
                                                <td colspan="1"><b>Total </b></td>

                                                <td colspan="2"><b>{{$total}}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>

            </div>


        </div>

    </div>

@endsection
