@extends('layouts.app')
@section('title', 'Novo Pacote')
@section('content')
<div class="">
    <div class="row gy-4">

        <!-- Lista -->
        <div class="col-8">
            <div class="card min-vh-100">
                <div class="card-body px-2 px-md-4 py-4">



                    <!-- lista -->
                    <div class="mt-2 pt-1 ">
                        <div class="">
                            <div
                                class="d-sm-flex text-center text-md-start justify-content-between gap-2 align-items-center">
                                <h1 class="fs-4 fw-600 mb-4 text-green-2">
                                    <i data-feather="package"></i>  Novo Pacote
                                </h1>



                            </div>

                            <form action="{{route('pacotes.store')}}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" class="form-control" name="descricao" id="descricao">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="descricao">Serviço</label>
                                    <select class="form-select" name="servico_id">
                                        <option>Selecione o serviço</option>
                                        @foreach($servicos as $servico)

                                        <option value="{{$servico->id}}">{{$servico->descricao}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="quantidade">Quantidade de fotos</label>
                                    <input type="text" class="form-control" name="quantidade" id="quantidade">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="valor">Valor</label>
                                    <input type="text" class="form-control" name="valor" id="valor">
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
@endsection
