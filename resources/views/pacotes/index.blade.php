@extends('layouts.app')
@section('title', 'Pacotes')

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
                                        <i data-feather="package"></i> Pacotes
                                    </h1>
                                    @can('admin')
                                        <div class="">
                                            <a class="btn btn-primary d-block d-md-inline-block mb-3 py-2 px-3   "
                                                href="{{ route('pacotes.create') }}" role="button" style="">
                                                <div class="d-flex justify-content-center gap-2 align-items-center py-1">
                                                    <i data-feather="package"></i>
                                                    Cadastrar novo pacote
                                                </div>
                                            </a>
                                            {{-- <a class="btn btn-primary d-block d-md-inline-block mb-3 py-2 px-3   "
                                            href="{{ route('pacotes.gera-cartoes') }}" role="button" style="">
                                            <div class="d-flex justify-content-center gap-2 align-items-center py-1">
                                                <i data-feather="hash"></i>
                                                Gerar Numeração
                                            </div>
                                        </a> --}}
                                        </div>
                                    @endcan

                                </div>
                                @canany(['admin', 'loja'])
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
                                @endcanany


                                <div class="table-responsive mt-5">
                                    <table class="table text-green-2 resultBusca">
                                        @canany(['admin', 'loja'])
                                            <thead>
                                                <tr class="fs-18px ">
                                                    <th scope="col"><span
                                                            class="text-green-2 d-inline-block pb-3">Descrição</span></th>
                                                    <th scope="col"><span class="text-green-2 d-inline-block pb-3">Quantidade
                                                            de fotos</span>
                                                    </th>
                                                    <th scope="col"><span
                                                            class="text-green-2 d-inline-block pb-3">Valor</span>
                                                    </th>

                                                    <th scope="col"><span
                                                            class="text-green-2 d-inline-block pb-3">Opção</span></th>



                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($pacotes as $pacote)
                                                    <tr class=" table-tr-cliente fw-500 fs-18px " data-bs-toggle="modal"
                                                        data-bs-target="@can('admin')#detalhes-produto-{{ $pacote->id }} @endcan @can('loja') #vender-produto-{{ $pacote->id }} @endcan"
                                                        style="cursor:pointer">
                                                        <td class="text-green">
                                                            <span class="text-green">

                                                                {{ $pacote->descricao }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-green">{{ $pacote->quantidade }}</span>
                                                        </td>

                                                        <td>
                                                            <span class="text-green">R$
                                                                {{ number_format($pacote->valor, 2, ',', '.') }}</span>
                                                        </td>

                                                        <td>
                                                            <span class="text-green"><i data-feather="edit"></i></span>
                                                        </td>



                                                    </tr>

                                                    <div class="modal modal-custom fade"
                                                        id="detalhes-produto-{{ $pacote->id }}" tabindex="-1"
                                                        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md border-0"
                                                            role="document">
                                                            <div class="modal-content bg-transparent ">
                                                                <div class="modal-body p-lg-5  border-0">

                                                                    <div class="p-4 shadow rounded-3  bg-white border">


                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"> Editar</h5>

                                                                        </div>

                                                                        <form
                                                                            action="{{ route('pacotes.update', $pacote->id) }}"
                                                                            method="post" id="form-remover">

                                                                            @csrf


                                                                            <input type="hidden" name="id"
                                                                                value="{{ $pacote->id }}">
                                                                            <div class="mb-2 pb-3">
                                                                                <div class="mb-0 position-relative">
                                                                                    <label for="descricao"
                                                                                        class="form-label text-green fw-500 fs-18px w-100">
                                                                                        <div
                                                                                            class="d-flex justify-content-between gap-2 w-100 align-items-center">
                                                                                            Descrição
                                                                                        </div>

                                                                                    </label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            class="form-control form-control-custom @error('descricao') is-invallid @enderror fs-18px fw-500"
                                                                                            name="descricao" id="descricao"
                                                                                            value="{{ $pacote->descricao }}" />


                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- Quantidade-->
                                                                            <div class="mb-2 pb-3">
                                                                                <div class="mb-0 position-relative">
                                                                                    <label for="qtd_estoque"
                                                                                        class="form-label text-green fw-500 fs-18px w-100">
                                                                                        <div
                                                                                            class="d-flex justify-content-between gap-2 w-100 align-items-center">
                                                                                            Quantidade
                                                                                        </div>

                                                                                    </label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            class="form-control form-control-custom @error('quantidade') is-invallid @enderror fs-18px fw-500"
                                                                                            name="quantidade" id="quantidade"
                                                                                            value="{{ $pacote->quantidade }}"
                                                                                            placeholder="0" />


                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Valor-->
                                                                            <div class="mb-2 pb-3">
                                                                                <div class="mb-0 position-relative">
                                                                                    <label for="qtd_estoque"
                                                                                        class="form-label text-green fw-500 fs-18px w-100">
                                                                                        <div
                                                                                            class="d-flex justify-content-between gap-2 w-100 align-items-center">
                                                                                            Valor
                                                                                        </div>

                                                                                    </label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            class="form-control form-control-custom @error('valor') is-invallid @enderror fs-18px fw-500"
                                                                                            name="valor" id="valor"
                                                                                            value="{{ $pacote->valor }}"
                                                                                            placeholder="0" />


                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <div class="row">

                                                                                <div class="col-md-6">
                                                                                    <button type="button"
                                                                                        class=" btn btn-secondary "
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">Cancelar</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="col-md-6">

                                                                                    <button type="submit"
                                                                                        id="modal-link-ver-maisS"
                                                                                        class="btn btn-primary w-100 py-2 fs-16px">Salvar</button>
                                                                                </div>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- vender --}}
                                                    <div class="modal modal-custom fade"
                                                        id="vender-produto-{{ $pacote->id }}" tabindex="-1"
                                                        data-bs-keyboard="false" role="dialog"
                                                        aria-labelledby="modalTitleId" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md border-0"
                                                            role="document">
                                                            <div class="modal-content bg-transparent ">
                                                                <div class="modal-body p-lg-5  border-0">

                                                                    <div class="p-4 shadow rounded-3  bg-white border">


                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"> Vender</h5>

                                                                        </div>

                                                                        <form
                                                                            action="{{ route('cartoes.vender', $pacote->id) }}"
                                                                            method="post" id="form-remover">

                                                                            @csrf


                                                                            <input type="hidden" name="id"
                                                                                value="{{ $pacote->id }}">

                                                                            <div class="mb-2 pb-3">
                                                                                <div class="mb-0 position-relative">
                                                                                    <label for="descricao"
                                                                                        class="form-label text-green fw-500 fs-18px w-100">
                                                                                        <div
                                                                                            class="d-flex justify-content-between gap-2 w-100 align-items-center">
                                                                                            Descrição
                                                                                        </div>

                                                                                    </label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            class="form-control form-control-custom @error('descricao') is-invallid @enderror fs-18px fw-500"
                                                                                            name="descricao" id="descricao"
                                                                                            value="{{ $pacote->descricao }}"
                                                                                            readonly />


                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- Quantidade-->
                                                                            <div class="mb-2 pb-3">
                                                                                <div class="mb-0 position-relative">
                                                                                    <label for="qtd_estoque"
                                                                                        class="form-label text-green fw-500 fs-18px w-100">
                                                                                        <div
                                                                                            class="d-flex justify-content-between gap-2 w-100 align-items-center">
                                                                                            Quantidade de fotos
                                                                                        </div>

                                                                                    </label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            class="form-control form-control-custom @error('quantidade') is-invallid @enderror fs-18px fw-500"
                                                                                            name="quantidade" id="quantidade"
                                                                                            value="{{ $pacote->quantidade }}"
                                                                                            placeholder="0" />


                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Valor-->
                                                                            <div class="mb-2 pb-3">
                                                                                <div class="mb-0 position-relative">
                                                                                    <label for="qtd_estoque"
                                                                                        class="form-label text-green fw-500 fs-18px w-100">
                                                                                        <div
                                                                                            class="d-flex justify-content-between gap-2 w-100 align-items-center">
                                                                                            Valor
                                                                                        </div>

                                                                                    </label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            class="form-control form-control-custom @error('valor') is-invallid @enderror fs-18px fw-500"
                                                                                            name="valor" id="valor"
                                                                                            value="{{ $pacote->valor }}"
                                                                                            placeholder="0" />


                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <div class="row">

                                                                                <div class="col-md-6">
                                                                                    <button type="button"
                                                                                        class=" btn btn-secondary "
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">Cancelar</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="col-md-6">

                                                                                    <button type="button"
                                                                                        id="modal-link-ver-mais"
                                                                                        class="btn btn-primary w-100 py-2 fs-16px"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#select-cliente-{{ $pacote->id }}">Confirmar</button>
                                                                                </div>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    {{-- Cliente --}}
                                                    <div class="modal modal-custom" id="select-cliente-{{ $pacote->id }}"
                                                        tabindex="-1" data-bs-keyboard="true" role="dialog"
                                                        aria-labelledby="modalTitleId" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md border-0"
                                                            role="document">
                                                            <div class="modal-content bg-transparent">
                                                                <div class="modal-body p-lg-5 border-0">
                                                                    <div class="p-4 shadow rounded-3 bg-white border">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Cliente</h5>
                                                                        </div>
                                                                        <form
                                                                            action="{{ route('pacotes.vender', $pacote->id) }}"
                                                                            method="post" id="form-remover">
                                                                            @csrf
                                                                            <input type="hidden" name="id"
                                                                                value="{{ $pacote->id }}">
                                                                            <input type="hidden" name="quantidade"
                                                                                value="{{ $pacote->quantidade }}">
                                                                            <input type="hidden" name="valor"
                                                                                value="{{ $pacote->valor }}">
                                                                            <div class="mb-2 pb-3">
                                                                                <label for="selectCliente"
                                                                                    class="form-label text-green fw-500 fs-18px w-100">
                                                                                    <div
                                                                                        class="d-flex justify-content-between gap-2 w-100 align-items-center mt-3">
                                                                                        Selecione o Cliente
                                                                                    </div>
                                                                                </label>
                                                                                <select class="form-select select2"
                                                                                    name="cliente"
                                                                                    id="selectCliente-{{ $pacote->id }}"
                                                                                    required>
                                                                                    <option value="">Selecione</option>
                                                                                    @foreach ($clientes as $cliente)
                                                                                        <option value="{{ $cliente->id }}">
                                                                                            {{ $cliente->nome }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                              <!-- Quantidade-->
                                                                              <div class="mb-2 pb-3">
                                                                                <div class="mb-0 position-relative">
                                                                                    <label for="qtd_pacotes"
                                                                                        class="form-label text-green fw-500 fs-18px w-100">
                                                                                        <div
                                                                                            class="d-flex justify-content-between gap-2 w-100 align-items-center">
                                                                                            Quantidade de pacotes
                                                                                        </div>

                                                                                    </label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            class="form-control form-control-custom @error('qtd_pacotes') is-invallid @enderror fs-18px fw-500"
                                                                                            name="qtd_pacotes" id="qtd_pacotes"
                                                                                            value="1"
                                                                                            placeholder="0" />


                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        Cancelar
                                                                                    </button>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary w-100 py-2 fs-16px">Vender</button>
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
                                    @endcanany


                                    @can('cliente')
                                        <table class="table text-green-2 resultBusca">
                                            <thead>
                                                <tr class="fs-18px ">

                                                    <th scope="col">#</th>

                                                    <th scope="col"><span
                                                            class="text-green-2 d-inline-block pb-3">Descrição</span></th>
                                                    <th scope="col"><span
                                                            class="text-green-2 d-inline-block pb-3">Quantidade de fotos</span>
                                                    </th>
                                                    <th scope="col"><span
                                                            class="text-green-2 d-inline-block pb-3">Valor</span>
                                                    </th>

                                                    <th scope="col"><span
                                                            class="text-green-2 d-inline-block pb-3">Saldo</span></th>

                                                    <th scope="col"><span
                                                            class="text-green-2 d-inline-block pb-3">Histórico</span></th>



                                                </tr>
                                            </thead>
                                            <tbody>
                                                @can('cliente')

                                                    @if ($pacotes->count() == 0)
                                                        <p class="text-danger">Você ainda não possui nenhum pacote de fotos!</p>
                                                    @endif
                                                @endcan
                                                @foreach ($pacotes as $cartao)
                                                    <tr
                                                        class=" table-tr-cliente fw-500 fs-18px @if ($cartao->quantidade == 0) text-danger @endif">
                                                        <td>{{ $loop->index + 1 }}</td>

                                                        <td class="text-green">
                                                            <span class="text-green">

                                                                {{ $cartao->descricao }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-green">{{ $cartao->quantidade }}</span>
                                                        </td>

                                                        <td>
                                                            <span class="text-green">R$
                                                                {{ number_format($cartao->valor, 2, ',', '.') }}</span>
                                                        </td>

                                                        <td>

                                                            <span class="text-green">{{ $cartao->saldo }}
                                                            </span>

                                                        </td>
                                                        <td>
                                                            <a href="{{ route('pdv.historico', ['pacote' => $cartao->id, 'cliente' => $cliente->id]) }}"
                                                                title="Histórico" class="m-3"><i
                                                                    class="fa-solid fa-clock-rotate-left"></i></a>
                                                        </td>



                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $pacotes->links() }}
                                    @endcan
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

            $('.modal').on('hidden.bs.modal', function() {
                $('body').removeClass('modal-open'); // Remove a classe que bloqueia o fundo
                $('.modal-backdrop').remove(); // Remove o backdrop (fundo escuro)
            });

            // Inicialize o Select2 quando a modal abrir
            $('.modal').on('shown.bs.modal', function() {
                $(this).find('.select2').select2({
                    dropdownParent: $(
                    this), // Faz o dropdown renderizar corretamente dentro da modal
                    width: '100%', // Ajusta a largura do campo
                    placeholder: "Selecione o Cliente", // Placeholder opcional
                    allowClear: true // Para permitir limpar a seleção
                });
            });

            // Garanta que o Select2 seja destruído quando a modal fechar (boa prática)
            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('.select2').select2('destroy');
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let resultado = $('.resultBusca');

            let clienteSelecionado = $('#selectCliente');

            $('#modal-link-ver-mais').click(function() {
                if (clienteSelecionado.val() == '') {

                    alert('selecione o cliente');

                }
            });







            $('#pesquisa').keyup(function() {

                $.ajax({
                    url: "{{ route('pacotes.busca') }}", // Arquivo PHP que processará a busca
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
