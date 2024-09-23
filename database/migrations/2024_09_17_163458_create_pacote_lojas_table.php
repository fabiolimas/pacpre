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
        Schema::create('pacote_lojas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pacote_id')->constrained()->onDelete('cascade');
            $table->double('valor', 10,2);
            $table->foreignId('loja_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacote_lojas');
    }
};
