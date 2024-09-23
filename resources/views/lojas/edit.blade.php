@extends('layouts.app')
@section('title', 'Cadastrar Loja')

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
                                        <i data-feather="list"></i> Editar Loja
                                    </h1>



                                </div>

                                <form action="{{ route('lojas.update', $loja->id) }}" method="post">
                                    @csrf
                                    <div class="row">

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="nfantasia">Nome</label>
                                                    <input type="text" class="form-control" name="nfantasia" id="nfantasia" value="{{$loja->nfantasia}}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="rsocial">Razão social</label>
                                                    <input type="text" class="form-control" name="rsocial" id="rsocial" value="{{$loja->rsocial}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-3">
                                                <div class="form-group">
                                                    <label for="cnpj">CNPJ</label>
                                                    <input type="text" class="form-control" name="cnpj" id="cnpj" value="{{$loja->cnpj}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-3">
                                                <div class="form-group">
                                                    <label for="insc_estadual">Inscrição Estadual</label>
                                                    <input type="text" class="form-control" name="insc_estadual" id="insc_estadual" value="{{$loja->insc_estadual}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="endereco">Endereço</label>
                                                    <input type="text" class="form-control" name="endereco" id="endereco" value="{{$loja->endereco}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-3">
                                                <div class="form-group">
                                                    <label for="bairro">Bairro</label>
                                                    <input type="text" class="form-control" name="bairro" id="bairro" value="{{$loja->bairro}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <div class="form-group">
                                                    <label for="cidade">Cidade</label>
                                                    <input type="text" class="form-control" name="cidade" id="cidade" value="{{$loja->cidade}}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-3">
                                                <div class="form-group">
                                                    <label for="uf">UF</label>
                                                    <select id="uf" name="uf" class="form-select">
                                                        <option value="{{$loja->uf}}" selected>{{$loja->uf}}</option>
                                                        <option value="AC">Acre</option>
                                                        <option value="AL">Alagoas</option>
                                                        <option value="AP">Amapá</option>
                                                        <option value="AM">Amazonas</option>
                                                        <option value="BA">Bahia</option>
                                                        <option value="CE">Ceará</option>
                                                        <option value="DF">Distrito Federal</option>
                                                        <option value="ES">Espírito Santo</option>
                                                        <option value="GO">Goiás</option>
                                                        <option value="MA">Maranhão</option>
                                                        <option value="MT">Mato Grosso</option>
                                                        <option value="MS">Mato Grosso do Sul</option>
                                                        <option value="MG">Minas Gerais</option>
                                                        <option value="PA">Pará</option>
                                                        <option value="PB">Paraíba</option>
                                                        <option value="PR">Paraná</option>
                                                        <option value="PE">Pernambuco</option>
                                                        <option value="PI">Piauí</option>
                                                        <option value="RJ">Rio de Janeiro</option>
                                                        <option value="RN">Rio Grande do Norte</option>
                                                        <option value="RS">Rio Grande do Sul</option>
                                                        <option value="RO">Rondônia</option>
                                                        <option value="RR">Roraima</option>
                                                        <option value="SC">Santa Catarina</option>
                                                        <option value="SP">São Paulo</option>
                                                        <option value="SE">Sergipe</option>
                                                        <option value="TO">Tocantins</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-3">
                                                <div class="form-group">
                                                    <label for="cep">CEP</label>
                                                    <input type="text" class="form-control" name="cep" id="cep" value="{{$loja->cep}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="telefone">Telefone</label>
                                                    <input type="text" class="form-control" name="telefone" id="telefone" value="{{$loja->telefone}}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="mail" class="form-control" name="email" id="email" value="{{$loja->email}}">
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
