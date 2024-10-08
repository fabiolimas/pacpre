@extends('layouts.app')
@section('title', 'Cadastrar Usuario')

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
                                        <i data-feather="user"></i> Cadastrar Usuario
                                    </h1>



                                </div>

                                <form action="{{ route('usuarios.store') }}" method="post">
                                    @csrf
                                    <div class="row">

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="name">Nome</label>
                                                    <input type="text" class="form-control" name="name" id="name">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="email">E-mail</label>
                                                    <input type="email" class="form-control" name="email" id="email">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="loja">Loja</label>
                                                    <select name="loja_id" class="form-select">
                                                        <option>Selecione a loja</option>
                                                        @foreach($lojas as $loja)
                                                        <option value="{{$loja->id}}">{{$loja->nfantasia}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="password">Senha</label>
                                                    <input type="password" class="form-control" name="password" id="password">
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
@endsection
