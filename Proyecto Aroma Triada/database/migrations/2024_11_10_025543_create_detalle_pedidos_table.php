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
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->id('id_detalle');
            $table->unsignedBigInteger('id_pedido'); // Define id_pedido como unsignedBigInteger
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos')->onDelete('cascade'); // Configura la clave foránea correctamente

            $table->unsignedBigInteger('id_producto')->nullable()->constrained('productos')->nullOnDelete();
            $table->unsignedBigInteger('id_servicio')->nullable()->constrained('servicios')->nullOnDelete();

            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->string('personalizacion', 255)->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
    }
};
