@extends('layouts.app')
@section('title', 'Serviços')

@section('content')
<div class="">
    <div class="row gy-4">

        <!-- Lista -->
        <div class="col-md-8 col-sm-12">
            <div class="card min-vh-100">
                <div class="card-body px-2 px-md-4 py-4">



                    <!-- lista -->
                    <div class="mt-2 pt-1 ">
                        <div class="">
                            <div
                                class="d-sm-flex text-center text-md-start justify-content-between gap-2 align-items-center">
                                <h1 class="fs-4 fw-600 mb-4 text-green-2">
                                    <i data-feather="shopping-cart"></i>  PDV
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

                                    <a class="btn btn-primary d-block d-md-inline-block mb-3 py-2 px-3   "
                                    href="{{route('pdv.create')}}" role="button"
                                    style="">
                                    <div class="d-flex justify-content-center gap-2 align-items-center py-1">
                                        <i data-feather="image"></i>
                                       Baixar Pontos do pacote
                                    </div>
                                </a>
                                </div>


                            </div>
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

        let resultado = $('.resultBusca');

        $('#pesquisa').keyup(function() {

            $.ajax({
                url: "{{ route('servicos.busca') }}", // Arquivo PHP que processará a busca
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
