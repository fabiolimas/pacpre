

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
                    class="text-green-2 d-inline-block pb-3">Descrição</span></th>
            <th scope="col"><span class="text-green-2 d-inline-block pb-3">Quantidade de fotos</span>
            </th>

                    <th scope="col"><span
                        class="text-green-2 d-inline-block pb-3">Opção</span></th>



        </tr>
    </thead>
    <tbody>
        @foreach ($servicos as $servico)
            <tr class=" table-tr-cliente fw-500 fs-18px " data-bs-toggle="modal"
                data-bs-target="#detalhes-produto-{{ $paservicocote->id }}"
                style="cursor:pointer">
                <td class="text-green">
                    <span  class="text-green">

                {{ $servico->descricao }}</span>
                </td>
                <td>
                    <span class="text-green">{{ $servico->quantidade }}</span>
                </td>

                <td>
                    <span
                    class="text-green"><i data-feather="edit"></i></span>
                </td>



            </tr>

            <div class="modal modal-custom fade" id="detalhes-produto-{{ $servico->id }}" tabindex="-1"
                data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md border-0" role="document">
                    <div class="modal-content bg-transparent ">
                        <div class="modal-body p-lg-5  border-0">

                            <div class="p-4 shadow rounded-3  bg-white border">


                                <div class="modal-header">
                                    <h5 class="modal-title"> Editar</h5>

                                  </div>

                                <form action="{{route('pacotes.update',$servico->id)}}" method="post"
                                    id="form-remover">

                                    @csrf


                                    <input type="hidden" name="id" value="{{ $servico->id }}">
                                    <div class="mb-2 pb-3">
                                        <div class="mb-0 position-relative">
                                            <label for="descricao" class="form-label text-green fw-500 fs-18px w-100">
                                                <div class="d-flex justify-content-between gap-2 w-100 align-items-center">
                                                    Descrição
                                                </div>

                                            </label>
                                            <div class="position-relative">
                                                <input type="text"
                                                    class="form-control form-control-custom @error('descricao') is-invallid @enderror fs-18px fw-500"
                                                    name="descricao" id="descricao" value="{{ $servico->descricao }}"
                                                    />


                                            </div>
                                        </div>
                                    </div>
                                    <!-- Quantidade-->
                                    <div class="mb-2 pb-3">
                                        <div class="mb-0 position-relative">
                                            <label for="qtd_estoque" class="form-label text-green fw-500 fs-18px w-100">
                                                <div class="d-flex justify-content-between gap-2 w-100 align-items-center">
                                                    Quantidade
                                                </div>

                                            </label>
                                            <div class="position-relative">
                                                <input type="text"
                                                    class="form-control form-control-custom @error('quantidade') is-invallid @enderror fs-18px fw-500"
                                                    name="quantidade" id="quantidade" value="{{ $servico->quantidade }}"
                                                    placeholder="0" />


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
