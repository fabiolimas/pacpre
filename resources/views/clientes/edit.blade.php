@extends('layouts.app')
@section('title', 'Editar Cliente')

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
                                        <i data-feather="user"></i> Editar Cliente
                                    </h1>



                                </div>

                                <form action="{{ route('clientes.update', $cliente->id) }}" method="post">
                                    @csrf
                                    <div class="row">

                                            <div class="col-md-8 mt-3">
                                                <div class="form-group">
                                                    <label for="name">Nome</label>
                                                    <input type="text" class="form-control" name="name" id="name" value="{{$cliente->nome}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <div class="form-group">
                                                    <label for="telefone">Telefone</label>
                                                    <input type="text" class="form-control" name="telefone" id="telefone" value="{{$cliente->telefone}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <div class="form-group">
                                                    <label for="cpf">CPF</label>
                                                    <input type="text" class="form-control" name="cpf" id="cpf" value="{{$cliente->cpf}}">
                                                </div>
                                            </div>
                                            <div class="col-md-8 mt-3">
                                                <div class="form-group">
                                                    <label for="endereco">Endereço</label>
                                                    <input type="text" class="form-control" name="endereco" id="endereco" value="{{$cliente->endereco}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <div class="form-group">
                                                    <label for="bairro">Bairro</label>
                                                    <input type="text" class="form-control" name="bairro" id="bairro" value="{{$cliente->bairro}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="cidade">Cidade</label>
                                                    <input type="text" class="form-control" name="cidade" id="cidade" value="{{$cliente->cidade}}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-3">
                                                <div class="form-group">
                                                    <label for="loja">Estado</label>

                                                        <select
                                                        class="form-select  @error('estado') is-invalid @enderror"
                                                        name="estado" id="estado" >
                                                        <option value="{{$cliente->estado}}">{{$cliente->estado}}</option>
                                                        <option value="AC">Acre</option>
                                                        <option value="AL">Alagoas</option>
                                                        <option value="AP">Amapá</option>
                                                        <option value="AM">Amazonas</option>
                                                        <option value="BA" selected>Bahia</option>
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
                                                        <option value="EX">Estrangeiro</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="email">E-mail</label>
                                                    <input type="email" class="form-control" name="email" id="email" value="{{$cliente->email}}">
                                                </div>
                                            </div>


                                            {{-- <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="password">Senha</label>
                                                    <input type="password" class="form-control" name="password" id="password" value="{{$cliente->password}}">
                                                </div>
                                            </div> --}}

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


    <script src="https://unpkg.com/imask"></script>
    <script>

const element = document.getElementById('cpf');
const telefone=document.querySelector('#telefone');
const maskOptions = {
  mask: '000.000.000-00'
};
const maskTelefone={
    mask:'(00) 00000-0000'
};
const mask = IMask(element, maskOptions);
const maskPhone=IMask(telefone, maskTelefone);
        </script>
@endsection
