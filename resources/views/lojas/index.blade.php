@extends('layouts.app')
@section('title', 'Lojas')

@section('content')
<div class="">
    <div class="row gy-4">

        <!-- Lista -->
        <div class="col-12">
            <div class="card min-vh-100">
                <div class="card-body px-2 px-md-4 py-4">



                    <!-- lista -->
                    <div class="mt-2 pt-1 ">
                        <div class="">
                            <div
                                class="d-sm-flex text-center text-md-start justify-content-between gap-2 align-items-center">
                                <h1 class="fs-4 fw-600 mb-4 text-green-2">
                                    <i data-feather="list"></i>  Lojas
                                </h1>
                                <div class="">
                                    <a class="btn btn-primary d-block d-md-inline-block mb-3 py-2 px-3   "
                                        href="{{route('lojas.create')}}" role="button"
                                        style="">
                                        <div class="d-flex justify-content-center gap-2 align-items-center py-1">
                                            <i data-feather="list"></i>
                                            Cadastrar nova loja
                                        </div>
                                    </a>
                                </div>


                            </div>
                            <!-- pesquisa -->
                            <div class="pt-3">
                                <div class="mb-3 position-relative">
                                    <label for="pesquisa" class="visually-hidden">Pesquisar</label>
                                    <input type="text" class="form-control input-pesquisar-cliente" name="pesquisa"
                                        id="pesquisa" placeholder="Pesquisar" />

                                    <button type="submit" class="btn btn-none text-green p-1"
                                        style="position: absolute; top:3px; right: 20px">
                                        <i data-feather="search"></i>
                                    </button>

                                </div>

                            </div>


                            <div class="table-responsive mt-5">
                                <table class="table text-green-2 resultBusca">
                                    <thead>
                                        <tr class="fs-18px ">
                                            <th scope="col"><span
                                                    class="text-green-2 d-inline-block pb-3">Fantasia</span></th>
                                            <th scope="col"><span class="text-green-2 d-inline-block pb-3">Razao Social</span>
                                            </th>
                                            <th scope="col"><span class="text-green-2 d-inline-block pb-3">CNPJ</span>
                                            </th>
                                            <th scope="col"><span class="text-green-2 d-inline-block pb-3">E-mail</span>
                                            </th>

                                                    <th scope="col"><span
                                                        class="text-green-2 d-inline-block pb-3">Opção</span></th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lojas as $loja)
                                            <tr class=" table-tr-cliente fw-500 fs-18px "
                                                style="cursor:pointer">
                                                <td class="text-green">
                                                    <span  class="text-green">

                                                {{ $loja->nfantasia }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-green">{{ $loja->rsocial }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-green">{{ $loja->cnpj }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-green">{{ $loja->email }}</span>
                                                </td>



                                                <td>
                                                    <a href="{{route('lojas.edit', $loja->id)}}"><span
                                                    class="text-green"><i data-feather="edit"></i></span></a>
                                                </td>



                                            </tr>

                                            <div class="modal modal-custom fade" id="detalhes-produto-{{ $loja->id }}" tabindex="-1"
                                                data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md border-0" role="document">
                                                    <div class="modal-content bg-transparent ">
                                                        <div class="modal-body p-lg-5  border-0">

                                                            <div class="p-4 shadow rounded-3  bg-white border">


                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"> Editar</h5>

                                                                  </div>

                                                                <form action="{{route('servicos.update',$loja->id)}}" method="post"
                                                                    id="form-remover">

                                                                    @csrf


                                                                    <div class="row">

                                                                        <div class="col-md-6 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="nfantasia">Nome</label>
                                                                                <input type="text" class="form-control" name="nfantasia" id="nfantasia">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="rsocial">Razão social</label>
                                                                                <input type="text" class="form-control" name="rsocial" id="rsocial">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="cnpj">CNPJ</label>
                                                                                <input type="text" class="form-control" name="cnpj" id="cnpj">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="insc_estadual">Inscrição Estadual</label>
                                                                                <input type="text" class="form-control" name="insc_estadual" id="insc_estadual">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="endereco">Endereço</label>
                                                                                <input type="text" class="form-control" name="endereco" id="endereco">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="bairro">Bairro</label>
                                                                                <input type="text" class="form-control" name="bairro" id="bairro">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="cidade">Cidade</label>
                                                                                <input type="text" class="form-control" name="cidade" id="cidade">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="uf">UF</label>
                                                                                <select id="uf" name="uf" class="form-select">
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
                                                                                <input type="text" class="form-control" name="cep" id="cep">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="telefone">Telefone</label>
                                                                                <input type="text" class="form-control" name="telefone" id="telefone">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="email">Email</label>
                                                                                <input type="mail" class="form-control" name="email" id="email">
                                                                            </div>
                                                                        </div>
                                                                </div>


                                                                    <div class="row">

                                                                        <div class="col-md-6">
                                                                            <button type="button" class=" btn btn-secondary " data-bs-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">Cancelar</span>
                                                                              </button>
                                                                        </div>
                                                                        <div class="col-md-6">

                                                                            <button type="submit" id="modal-link-ver-mais"
                                                                                class="btn btn-primary w-100 py-2 fs-16px">Salvar</button>
                                                                        </div>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
                url: "{{ route('lojas.busca') }}", // Arquivo PHP que processará a busca
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
