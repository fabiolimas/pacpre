<?php

namespace Database\Seeders;

use App\Models\Loja;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LojaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $loja=Loja::create([
            'rsocial'=>'José Luciano Vieira Costa',
            'nfantasia'=>'Foto Imagem LTDA',
            'cnpj'=>'04.539.935/0001-00',
            'insc_estadual'=>'028370805',
            'telefone'=>' (74)98802-0152',
            'cep'=>'56304-920',
            'endereco'=>'Av. Guararapes, 1783',
            'complemento'=>'',
            'bairro'=>'Centro',
            'cidade'=>'Petrolina',
            'uf'=>'PE',
            'email'=>'adm@fotoimagem.com.br'

        ]);

        $loja=Loja::create([
            'rsocial'=>'José Luciano Vieira Costa Eireli - EPP',
            'nfantasia'=>'Imagem Foto e Ótica',
            'cnpj'=>'16.480.857/0001-96',
            'insc_estadual'=>'26503536',
            'telefone'=>' (74)3621-3085',
            'cep'=>'44700-000',
            'endereco'=>'Av. Orlando Oliveira Pires, 206',
            'complemento'=>'',
            'bairro'=>'Centro',
            'cidade'=>'Jacobina',
            'uf'=>'BA',
            'email'=>'loja1@fotoimagem.com.br'

        ]);
        $loja=Loja::create([
            'rsocial'=>'José Luciano Vieira Costa Eireli - EPP',
            'nfantasia'=>'Imagem Foto - Juazeiro',
            'cnpj'=>'16.480.857/0006-09',
            'insc_estadual'=>'46845193',
            'telefone'=>' (74)3621-7373',
            'cep'=>'48903-470',
            'endereco'=>'Av. Rua Américo Alves, 14',
            'complemento'=>'',
            'bairro'=>'Centro',
            'cidade'=>'Juazeiro',
            'uf'=>'BA',
            'email'=>'loja10@fotoimagem.com.br'

        ]);

        $loja=Loja::create([
            'rsocial'=>'José Luciano Vieira Costa Eireli - EPP',
            'nfantasia'=>'Imagem Foto - Juazeiro',
            'cnpj'=>'16.480.857/0006-09',
            'insc_estadual'=>'46845193',
            'telefone'=>' (74)3621-7373',
            'cep'=>'48903-470',
            'endereco'=>'Av. Rua Américo Alves, 14',
            'complemento'=>'',
            'bairro'=>'Centro',
            'cidade'=>'Juazeiro',
            'uf'=>'BA',
            'email'=>'loja10@fotoimagem.com.br'

        ]);

    }

}
