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
        Schema::table('clientes', function (Blueprint $table) {
          $table->string('cpf')->unique();
          $table->string('cidade')->nullable();
          $table->string('bairro')->nullable();
          $table->string('estado')->nullable();
          $table->string('data_nascimento')->nullable();
          $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn(['cpf','bairro','estado','data_nascimento','status']);
        });
    }
};
