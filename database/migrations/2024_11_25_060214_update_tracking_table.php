<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tracking', function (Blueprint $table) {
            // Cambiar el estado_actual a enum con los mismos estados que la tabla venta
            $table->enum('estado_actual', ['En proceso', 'Enviado', 'Entregado', 'Cancelado'])
                  ->default('En proceso')
                  ->change();

            // Asegurarse de que id_pedido esté relacionado con la tabla venta
            $table->foreign('id_venta')->references('id_pedido')->on('venta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tracking', function (Blueprint $table) {
            // Revertir cambios: volver a string o lo que era antes
            $table->string('estado_actual')->change();

            // Eliminar la relación con venta
            $table->dropForeign(['id_pedido']);
        });
    }
};
