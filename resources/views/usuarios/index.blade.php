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
                                    <i data-feather="user"></i>  Usuarios
                                </h1>
                                <div class="">
                                    <a class="btn btn-primary d-block d-md-inline-block mb-3 py-2 px-3   "
                                        href="{{route('usuarios.create')}}" role="button"
                                        style="">
                                        <div class="d-flex justify-content-center gap-2 align-items-center py-1">
                                            <i data-feather="user"></i>
                                            Cadastrar novo usuario
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
                                                    class="text-green-2 d-inline-block pb-3">Nome</span></th>
                                            <th scope="col"><span class="text-green-2 d-inline-block pb-3">E-mail</span>
                                            </th>


                                                    <th scope="col"><span
                                                        class="text-green-2 d-inline-block pb-3">Opção</span></th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $usuario)
                                            <tr class=" table-tr-cliente fw-500 fs-18px "
                                                style="cursor:pointer">
                                                <td class="text-green">
                                                    <span  class="text-green">

                                                {{ $usuario->name }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-green">{{ $usuario->email }}</span>
                                                </td>



                                                <td>
                                                    <a href="{{route('usuarios.edit', $usuario->id)}}"><span
                                                    class="text-green"><i data-feather="edit"></i></span></a>
                                                </td>



                                            </tr>

                                            <div class="modal modal-custom fade" id="detalhes-produto-{{ $usuario->id }}" tabindex="-1"
                                                data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md border-0" role="document">
                                                    <div class="modal-content bg-transparent ">
                                                        <div class="modal-body p-lg-5  border-0">

                                                            <div class="p-4 shadow rounded-3  bg-white border">


                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"> Editar</h5>

                                                                  </div>

                                                                <form action="{{route('usuarios.update',$usuario->id)}}" method="post"
                                                                    id="form-remover">

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
                                                                        <div class="col-md-3 mt-3">
                                                                            <div class="form-group">
                                                                                <label for="password">Senha</label>
                                                                                <input type="password" class="form-control" name="password" id="password">
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
                url: "{{ route('usuarios.busca') }}", // Arquivo PHP que processará a busca
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
