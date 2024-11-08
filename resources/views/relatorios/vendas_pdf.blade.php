
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de vendas</title>
</head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding:5px;
}
.card {
    padding: 5px;
    margin: 0 auto;
    /* display: table; */
    /* width: 80%; */
}
.cabecalho table {
    /* background: red; */
    width: 100%;
    border:none;

}
.cabecalho td {
    border: none;
}
.cabecalho img {
    margin: 0 auto;
    padding: 5px;
    width: 134px;
    display: block;
}
.table-responsive.mt-5 table {
    width: 100%;
}
.table-responsive.mt-5 {
    width: 100%;
}
*{
    font-family: 'Inter','sans-serif';
}
</style>
<body>

    <!-- Quantidade de cartões vendidos -->
    @canany(['admin', 'loja'])
    <div class="col-12 col-lg-8 col-xl-12">
        <div class="card">
            <div class="cabecalho">
                <div class="card-body px-4 py-4">


                    <table>
                        <tr>
                            <td><a class="navbar-brand" href="#">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="" width="90" class="logo">
                            </a>
                        </td>
                        <td>
                            <p>Relatório de Vendas</p>
                            <p>Loja: <b>{{$loja->nfantasia}}</b></p>
                            <p>Periodo: <b>{{date('d-m-Y', strtotime($dataInicio))}} a {{date('d-m-Y', strtotime($dataFim))}}</b></p>

                        </td>
                        </tr>
                    </table>


                </div>

            </div>



            <div class="table-responsive mt-5">
                <table class="table text-green-2 resultBusca" border="1" collapse='colapsed'>
                    <thead>
                        <tr class="fs-18px ">
                            <th scope="col"><span class="text-green-2 d-inline-block pb-3">Cliente</span></th>
                            <th scope="col"><span class="text-green-2 d-inline-block pb-3">Descrição</span></th>
                            <th scope="col"><span class="text-green-2 d-inline-block pb-3">Valor
                                </span>
                            </th>




                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendas as $venda)
                            <tr class=" table-tr-cliente fw-500 fs-18px " style="cursor:pointer">
                                <td class="text-green">
                                    <span class="text-green">

                                        {{ $venda->nome }}</span>
                                </td>

                                <td>
                                    <span class="text-green">{{ $venda->descricao }}</span>
                                </td>


                                <td style="text-align: center">
                                    <span class="text-green" >R$
                                        {{ number_format($venda->valor, 2, ',', '.') }}</span>
                                </td>





                            </tr>
                            @php
                                $total+=$venda->valor;
                            @endphp
                        @endforeach
                        <tr>
                            <th colspan="2" style="text-align: right">Total</th>

                            <th>R$ {{number_format($total,2,',','.')}}</th>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endcanany






</div>
</body>
</html>





