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
        Schema::table('pacotes_clientes', function (Blueprint $table) {
            $table->integer('loja_id')->nullble();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pacotes_clientes', function (Blueprint $table) {
           $table->dropColumn('loja_id');
        });
    }
};
