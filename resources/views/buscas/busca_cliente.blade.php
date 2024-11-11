

<!-- Feather icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.1/feather.min.js"
integrity="sha512-4lykFR6C2W55I60sYddEGjieC2fU79R7GUtaqr3DzmNbo0vSaO1MfUjMoTFYYuedjfEix6uV9jVTtRCSBU/Xiw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
/* activer feather icons */
feather.replace();
</script>


<table class="table text-green-2 resultBusca">
    <thead>
        <tr class="fs-18px ">
            <th scope="col"><span
                    class="text-green-2 d-inline-block pb-3">Nome</span></th>
            <th scope="col"><span
                    class="text-green-2 d-inline-block pb-3">Telefone</span>
            </th>
            <th scope="col"><span
                class="text-green-2 d-inline-block pb-3">CPF</span>
        </th>
            <th scope="col"><span
                    class="text-green-2 d-inline-block pb-3">E-mail</span>
            </th>
            <th scope="col"><span
                    class="text-green-2 d-inline-block pb-3">Opção</span></th>



        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $usuario)
            <tr class=" table-tr-cliente fw-500 fs-18px "
                style="cursor:pointer">
                <td class="text-green">
                    <span  class="text-green">

                {{ $usuario->nome }}</span>
                </td>
                <td>
                    <span class="text-green">{{ $usuario->telefone }}</span>
                </td>
                <td>
                    <span class="text-green">{{ $usuario->cpf }}</span>
                </td>
                <td>
                    <span class="text-green">{{ $usuario->email }}</span>
                </td>



                <td>
                    <a href="{{ route('clientes.edit', $usuario->id) }}" title="Editar"><span
                            class="text-green"><i data-feather="edit"></i></span>
                        </a>|
                            <a href="{{ route('clientes.pacotes', $usuario->id) }}" title="Pactoes Cliente"><span
                                class="text-green"><i data-feather="credit-card"></i></span></a>
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
