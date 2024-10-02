<table class="table text-green-2 resultBusca">
    <thead>
        <tr class="fs-18px ">

            <th scope="col">#</th>

            <th scope="col"><span class="text-green-2 d-inline-block pb-3">Descrição</span></th>
            <th scope="col"><span class="text-green-2 d-inline-block pb-3">Quantidade de fotos</span>
            </th>
            <th scope="col"><span class="text-green-2 d-inline-block pb-3">Valor</span>
            </th>

            <th scope="col"><span class="text-green-2 d-inline-block pb-3">Saldo</span></th>

            <th scope="col"><span class="text-green-2 d-inline-block pb-3">Opções</span></th>



        </tr>
    </thead>
    <tbody>
        @foreach ($pacotes as $cartao)
            <tr class=" table-tr-cliente fw-500 fs-18px @if ($cartao->quantidade == 0) text-danger @endif">
                <td>{{ $loop->index + 1 }}</td>

                <td class="text-green">
                    <span class="text-green">

                        {{ $cartao->descricao }}</span>
                </td>
                <td>
                    <span class="text-green">{{ $cartao->qtd }}</span>
                </td>

                <td>
                    <span class="text-green">R$ {{ number_format($cartao->valor, 2, ',', '.') }}</span>
                </td>

                <td>

                        <span class="text-green">{{ $cartao->saldo }}
                        </span>

                </td>
                <td>
                    <a href="{{route('pdv.historico',$cartao->id)}}" title="Histórico" class="m-3"><i
                            class="fa-solid fa-clock-rotate-left"></i></a>|<i class="fa-solid fa-download"
                        data-bs-toggle="modal" data-bs-target="#baixar-produto-{{ $cartao->id }}" title="Baixar"
                        style="cursor:pointer; margin-left:10px"></i>
                </td>



            </tr>

            <div class="modal modal-custom fade" id="baixar-produto-{{ $cartao->id }}" tabindex="-1"
                data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md border-0"
                    role="document">
                    <div class="modal-content bg-transparent">
                        <div class="modal-body p-lg-5 border-0">
                            <div class="p-4 shadow rounded-3 bg-white border">
                                <div class="modal-header">
                                    <h5 class="modal-title">Baixa em Pacote</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button> <!-- Fechar modal -->
                                </div>

                                <form action="#" method="post"
                                    id="form-confirma">
                                    @csrf
                                    <input type="hidden" name="id-{{$cartao->id}}" value="{{ $cartao->id }}">
                                    <input type="hidden" name="descricao" id="descricao-{{$cartao->id}}" value="{{ $cartao->descricao }}">

                                    <!-- Serviço -->
                                    <div class="mb-2 pb-3 mt-2">
                                        <div class="mb-0 position-relative">
                                            <label for="servico_id" class="form-label text-green fw-500 fs-18px w-100">
                                                <div
                                                    class="d-flex justify-content-between gap-2 w-100 align-items-center">
                                                    Serviço</div>
                                            </label>
                                            <select class="form-select form-control-custom" name="servico_id"
                                                id="servico_id-{{$cartao->id}}" required>
                                                <option value="">Selecione o serviço</option>
                                                @foreach ($servicos as $servico)
                                                    <option value="{{ $servico->id }}">{{ $servico->descricao }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Quantidade -->
                                    <div class="mb-2 pb-3">
                                        <div class="mb-0 position-relative">
                                            <label for="quantidade" class="form-label text-green fw-500 fs-18px w-100">
                                                <div
                                                    class="d-flex justify-content-between gap-2 w-100 align-items-center">
                                                    Quantidade</div>
                                            </label>
                                            <input type="number"
                                                class="form-control form-control-custom  fs-18px fw-500"
                                                name="quantidade" id="quantidade-{{$cartao->id}}" placeholder="0" required />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="submit" id="confirmaBaixa-{{$cartao->id}}"
                                                class="btn btn-primary w-100 py-2 fs-16px" value="Confirmar">
                                        </div>
                                    </div>
                                </form>
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


                    $('#confirmaBaixa-{{$cartao->id}}').click(function() {

                        $.ajax({
                            url: "{{ route('pdv.baixar-pontos', $cartao->id) }}", // Arquivo PHP que processará a busca
                            type: "post",
                            data: {
                                id: $('#id-{{$cartao->id}}').val(),
                                quantidade:$('#quantidade-{{$cartao->id}}').val(),
                                descricao:$('#descricao-{{$cartao->id}}').val(),
                                servico_id:$('#servico_id-{{$cartao->id}}').val(),

                            }, // Dados a serem enviados para o servidor
                            success: function(response) {

                               window.location.reload();
                                resultado.html(response.status);
                            },
                            error: function(result) {
                                console.log(result);
                            }



                        });
                    });


                });
            </script>
        @endforeach
    </tbody>
</table>
{{ $pacotes->links() }}
