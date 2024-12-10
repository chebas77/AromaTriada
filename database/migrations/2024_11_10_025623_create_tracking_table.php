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
        Schema::create('tracking', function (Blueprint $table) {
            $table->id('id_tracking'); // Clave primaria
            $table->unsignedBigInteger('id_pedido'); // Asegúrate de que id_pedido sea unsignedBigInteger para coincidencia

            // Configura la clave foránea a pedidos correctamente
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos')->onDelete('cascade');

            $table->string('origen', 100);
            $table->string('destino', 100);
            $table->string('estado_actual', 50);
            $table->date('fecha_despacho')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->time('hora_programada')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking');
    }
};
