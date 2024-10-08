@extends('layouts.app')
@section('title', 'Gerar Numeração')
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
                                    <i data-feather="credit-card"></i>  Gerador de Cartões
                                </h1>



                            </div>

                            <form action="{{route('pacotes.store-cartoes')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="loja">Loja</label>
                                        <select class="form-select" name="loja_id">
                                            <option value="">Selecione a loja</option>
                                            @foreach($lojas as $loja)

                                                <option value="{{$loja->id}}">{{$loja->nfantasia}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="descricao">Pacote</label>
                                        <select class="form-select" name="pacote_id">
                                            <option value="">Selecione o Pacote</option>
                                            @foreach($pacotes as $pacote)

                                                <option value="{{$pacote->id}}">{{$pacote->descricao}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mt-3">
                                            <label for="serviço">Serviço do cartão</label>
                                            <select class="form-select" name="servico_id">
                                                <option value="">Selecione o serviço</option>
                                                @foreach($servicos as $servico)

                                                    <option value="{{$servico->id}}">{{$servico->descricao}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mt-3">
                                            <label for="quantidade">Quantidade de fotos</label>
                                            <input type="text" class="form-control" name="quantidade" id="quantidade">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mt-3">
                                            <label for="num_inicio">Numeração inicial</label>
                                            <input type="text" class="form-control" name="num_inicio" id="num_inicio">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-3">
                                            <label for="num_fim">Numeração final</label>
                                            <input type="text" class="form-control" name="num_fim" id="num_fim">
                                        </div>
                                    </div>
                                </div>
















                                <div class="form-group mt-3">
                                    <button class="btn btn-primary" type="submit">Salvar</button>
                                </div>
                            </form>





                        </div>
                    </div>

                </div>
            </div>

        </div>


    </div>

</div>
<script>

$(document).ready(function(){

    $('#num_inicio').change(function(){

        $('#num_fim').val(parseInt($('#num_inicio').val()) + parseInt($('#quantidade').val())-1);
    });

});
    </script>
@endsection
