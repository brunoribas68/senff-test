<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nome único da categoria
            $table->text('description')->nullable(); // Descrição opcional
            $table->boolean('is_active')->default(true); // Status ativo/inativo
            $table->timestamps(); // Datas de criação e atualização
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
