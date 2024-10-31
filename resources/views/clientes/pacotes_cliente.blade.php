@extends('layouts.app')
@section('title', 'Pacotes')

@section('content')


    <div class="">
        <div class="row gy-4">

            <!-- Lista -->
            <div class="col-md-12 col-sm-12">
                <div class="card min-vh-100">
                    <div class="card-body px-2 px-md-4 py-4">

                        <div class="msg"></div>

                        <!-- lista -->
                        <div class="mt-2 pt-1 ">
                            <div class="">
                                <div
                                    class="d-sm-flex text-center text-md-start justify-content-between gap-2 align-items-center">
                                    <h1 class="fs-4 fw-600 mb-4 text-green-2">
                                        <i data-feather="credit-cartd"></i> Pacotes Cliente
                                    </h1>




                                </div>

                                <div class="row">

                                    {{-- <div class="col-md-6">
                                        <div class="pt-3">
                                            <div class="mb-3 position-relative">
                                                <label for="pesquisa" class="">Nome</label>
                                                <select class="form-select" name="cliente" id="pesquisa">
                                                    <option value="">Selecione o cliente</option>
                                                    @foreach ($clientes as $cliente)
                                                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                                    @endforeach

                                                </select>

                                                <button type="submit" class="btn btn-none text-green p-1"
                                                    style="position: absolute; top:3px; right: 20px">
                                                    <i data-feather="search"></i>
                                                </button>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6"> --}}
                                        <!-- pesquisa -->



                                    </div>
                                </div>



                                <div class="table-responsive mt-5">
                                    <table class="table text-green-2 resultBusca">
                                        <thead>
                                            <tr class="fs-18px ">

                                                <th scope="col"><span class="text-green-2 d-inline-block pb-3">#</span></th>

                                                <th scope="col"><span class="text-green-2 d-inline-block pb-3">Descrição</span></th>
                                                <th scope="col"><span class="text-green-2 d-inline-block pb-3">Quantidade de fotos</span>
                                                </th>
                                                <th scope="col"><span class="text-green-2 d-inline-block pb-3">Valor</span>
                                                </th>

                                                <th scope="col"><span class="text-green-2 d-inline-block pb-3">Saldo</span></th>

                                                <th scope="col"><span class="text-green-2 d-inline-block pb-3">Opções</span></th>



                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($pacotes as $cartao)


                                            <tr class=" table-tr-cliente fw-500 fs-18px @if ($cartao->saldo == 0 && $cartao->usado != null) text-danger @endif">
                                                <td>{{ $loop->index + 1 }}</td>

                                                <td class="@if ($cartao->saldo == 0 && $cartao->usado != null) text-danger @else text-green @endif ">
                                                    <span class="@if ($cartao->saldo == 0 && $cartao->usado != null) text-danger @else text-green @endif ">

                                                        {{ $cartao->descricao }}</span>
                                                </td>
                                                <td>
                                                    <span class="@if ($cartao->saldo == 0 && $cartao->usado != null) text-danger @else text-green @endif ">{{ $cartao->qtd }}</span>
                                                </td>

                                                <td>
                                                    <span class="@if ($cartao->saldo == 0 && $cartao->usado != null) text-danger @else text-green @endif ">R$ {{ number_format($cartao->valor, 2, ',', '.') }}</span>
                                                </td>

                                                <td>

                                                        <span class="@if ($cartao->saldo == 0 && $cartao->usado != null) text-danger @else text-green @endif ">{{ $cartao->saldo }}
                                                        </span>

                                                </td>
                                                <td>
                                                    <a href="{{route('pdv.historico',$cartao->id)}}" title="Histórico" class="m-3" ><i
                                                            class="fa-solid fa-clock-rotate-left"></i></a>
                                                </td>



                                            </tr>



                                        @endforeach

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
    <script src="https://unpkg.com/imask"></script>
    <script>

const element = document.getElementById('pesquisacpf');

const maskOptions = {
  mask: '000.000.000-00'
};

const mask = IMask(element, maskOptions);

        </script>
    <script>
        $(document).ready(function() {
            $('#pesquisa').select2();
        });
        $('document').ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let resultado = $('.resultBusca');

            $('#pesquisa').change(function() {

                $.ajax({
                    url: "{{ route('pdv.busca') }}", // Arquivo PHP que processará a busca
                    type: "get",
                    data: {
                        pesquisa: $('#pesquisa').val(),


                    }, // Dados a serem enviados para o servidor
                    success: function(response) {

                        resultado.html(response);
                        resultado.html(response.status);
                    },
                    error: function(result) {
                        console.log(result);
                    }



                });
            });

            $('#pesquisacpf').change(function() {

                $.ajax({
                    url: "{{ route('pdv.busca') }}", // Arquivo PHP que processará a busca
                    type: "get",
                    data: {
                        pesquisacpf: $('#pesquisacpf').val(),


                    }, // Dados a serem enviados para o servidor
                    success: function(response) {

                        resultado.html(response);
                        resultado.html(response.status);
                    },
                    error: function(result) {
                        console.log(result);
                    }



                });
            });

        });
    </script>
@endsection
