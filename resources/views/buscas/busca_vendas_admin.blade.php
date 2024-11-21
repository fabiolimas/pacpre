

<!-- Feather icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.1/feather.min.js"
integrity="sha512-4lykFR6C2W55I60sYddEGjieC2fU79R7GUtaqr3DzmNbo0vSaO1MfUjMoTFYYuedjfEix6uV9jVTtRCSBU/Xiw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
/* activer feather icons */
feather.replace();
</script>



<div class="col-md-12">

    <div class="row">
        <div class="col-md-12">
            <div class="">
                @foreach ($vendas as $venda)

                    <div class="vendasindi">

                        <div class="row">
                            <div class="col-md-12">
                                {{ $venda->nome }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 nodvalue">
                                R$ {{ number_format($venda->valor, 2, ',', '.') }}
                            </div>
                            <div class="col-md-3 nod">
                                {{ $venda->descricao }} - {{ $venda->quantidade }}
                            </div>
                            <div class="col-md-3 nod">
                                {{ $venda->nfantasia }}
                            </div>


                            <div class="col-md-4 nodoption">
                                <a href="{{ route('pdv.venda', ['id'=>$venda->id]) }}"
                                    class="btn btn-success"><i data-feather="check"></i></a>
                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


        </div>
    </div>

</div>

