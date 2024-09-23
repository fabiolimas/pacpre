@extends('layouts.app')
@section('title', 'Criar Serviço')

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
                                    <i data-feather="image"></i>  Novo Serviço
                                </h1>



                            </div>

                            <form action="{{route('servicos.store')}}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" class="form-control" name="descricao" id="descricao">
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
