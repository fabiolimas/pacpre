<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lojas', function (Blueprint $table) {
            $table->id();
            $table->string('rsocial');
            $table->string('nfantasia');
            $table->string('cnpj');
            $table->string('insc_estadual');
            $table->string('telefone');
            $table->string('cep');
            $table->string('endereco');
            $table->string('complemento')->nuable();
            $table->string('bairro');
            $table->string('cidade');
            $table->string('uf');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lojas');
    }
};
