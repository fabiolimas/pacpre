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
                                    <form method="post" action="#">
                                        @csrf
                                        <div class="row mb-4">
                                            <div class="col-md-3">
                                                <label for="data_inicio">Data Inicial:</label>
                                                <input type="date" name="data_inicio" class="form-control"
                                                    value="{{ $dataInicio }}" required id="dataInicio">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="data_fim">Data Final:</label>
                                                <input type="date" name="data_fim" class="form-control"
                                                    value="{{ $dataFim }}" required id="dataFim" >
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
                                                <button type="button" class="btn btn-primary" id="search"> <i
                                                        data-feather="search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="">

                                    </div>
                                </div>
                            </div>


                        </div>



                    </div>
                </div>


            @endcanany






        </div>


<script>



            $('document').ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let dataInicial = $('#dataInicio');
                let dataFinal = $('#dataFim');
                let loja = $('#loja');


                $('#search').click(function() {

                    if(loja.val() == '' || loja.val() == null){
                    alert('Selecione uma loja');
                    return;
                }


                    $.ajax({
                        url: "{{ route('relatorio.vendas_pdf') }}", // Arquivo PHP que processará a busca
                        type: "post",
                        data: {
                           dataInicial: dataInicial.val(),
                           dataFinal: dataFinal.val(),
                           loja: loja.val()


                        }, // Dados a serem enviados para o servidor
                        success: function(response) {
                            console.log(response); // Para verificar a resposta no console
        if (response.url) {
            window.open(response.url, '_blank');
        } else {
            console.error('URL não encontrada na resposta:', response);
        }
    },
    error: function(xhr, status, error) {
        console.error('Erro ao gerar o PDF:', error);
    }


                    });
                });
            });




</script>
    @endsection

