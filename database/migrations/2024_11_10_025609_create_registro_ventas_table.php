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
        Schema::create('registro_ventas', function (Blueprint $table) {
            $table->id('id_registro'); // Clave primaria
            $table->unsignedBigInteger('id_pedido'); // Define id_pedido como unsignedBigInteger para compatibilidad

            // Define la clave foránea correctamente
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos')->onDelete('cascade');

            $table->date('fecha_venta');
            $table->decimal('monto_total', 10, 2);
            $table->string('metodo_pago', 50)->nullable();
            $table->enum('estado', ['Pagado', 'Pendiente']);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_ventas');
    }
};
