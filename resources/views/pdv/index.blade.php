@extends('layouts.app')
@section('title', 'PDV')

@section('content')
    <div class="">
        <div class="row gy-4">

            <!-- Lista -->
            <div class="col-md-12 col-sm-12">
                <div class="card min-vh-100">
                    <div class="card-body px-2 px-md-4 py-4">



                        <!-- lista -->
                        <div class="mt-2 pt-1 ">
                            <div class="">
                                <div
                                    class="d-sm-flex text-center text-md-start justify-content-between gap-2 align-items-center">
                                    <h1 class="fs-4 fw-600 mb-4 text-green-2">
                                        <i data-feather="shopping-cart"></i> PDV
                                    </h1>
                                    <div class="">
                                        {{-- <a class="btn btn-primary d-block d-md-inline-block mb-3 py-2 px-3   "
                                        href="{{route('servicos.create')}}" role="button"
                                        style="">
                                        <div class="d-flex justify-content-center gap-2 align-items-center py-1">
                                            <i data-feather="credit-card"></i>
                                            Vender Cartão
                                        </div>
                                    </a> --}}
                                        @can('loja')
                                            <a class="btn btn-primary d-block d-md-inline-block mb-3 py-2 px-3   "
                                                href="{{ route('pdv.create') }}" role="button" style="">
                                                <div class="d-flex justify-content-center gap-2 align-items-center py-1">
                                                    <i data-feather="image"></i>
                                                    Baixar Pontos do pacote
                                                </div>
                                            </a>
                                        @endcan
                                    </div>


                                </div>
                                @can('admin')
                                    <div class="row">
                                        <!-- pesquisa -->
                                        <div class="pt-3">
                                            <div class="mb-3 position-relative">
                                                <label for="pesquisa" class="visually-hidden">Pesquisar</label>
                                                <input type="text" class="form-control input-pesquisar-cliente"
                                                    name="pesquisa" id="pesquisa" placeholder="Pesquisar" autocomplete="off" />

                                                <button type="submit" class="btn btn-none text-green p-1"
                                                    style="position: absolute; top:3px; right: 20px">
                                                    <i data-feather="search"></i>
                                                </button>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="row conteudovenda">
                                        <div class="col-md-12">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="">
                                                        @foreach ($vendas as $venda)

                                                            <div class="vendasindi">

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        {{ $venda->nome }}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3 nodvalue">
                                                                        R$ {{ number_format($venda->valor, 2, ',', '.') }}
                                                                    </div>
                                                                    <div class="col-md-3 nod">
                                                                        {{ $venda->descricao }} - {{ $venda->quantidade }}
                                                                    </div>
                                                                    <div class="col-md-3 nod">
                                                                        {{ $venda->nfantasia }}
                                                                    </div>

                                                                    {{-- <div class="col-md-4 nodoption">
                                                                        <a href="{{ route('pdv.excluir_venda', $venda->id) }}"
                                                                            class="btn"><i data-feather="trash"></i></a>
                                                                    </div> --}}
                                                                    <div class="col-md-4 nodoption">
                                                                        <a href="{{ route('pdv.venda', $venda->id) }}"
                                                                            class="btn btn-success"><i data-feather="check"></i></a>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </a>
                                                        @endforeach

                                                    </div>


                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endcan




                                <!-- pesquisa -->





                            </div>
                        </div>

                    </div>
                </div>

            </div>


        </div>

    </div>
    <script>
        $('document').ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let resultado = $('.conteudovenda');

            $('#pesquisa').keyup(function() {

                $.ajax({
                    url: "{{ route('pdv.busca_vendas_admin') }}", // Arquivo PHP que processará a busca
                    type: "post",
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

        });
    </script>
@endsection
