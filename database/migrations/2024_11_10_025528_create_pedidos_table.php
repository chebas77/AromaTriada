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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('id_pedido');
            $table->date('fecha');
            $table->enum('estado', ['En proceso', 'Enviado', 'Entregado', 'Cancelado']);
            $table->decimal('total', 10, 2);
            $table->foreignId('id_usuario')->constrained('users'); // Referencia a la tabla users de Jetstream
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
