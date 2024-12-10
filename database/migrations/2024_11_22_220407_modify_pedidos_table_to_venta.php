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
        // Renombrar la tabla pedidos a venta
        Schema::rename('pedidos', 'venta');

        // Modificar la estructura de la tabla venta
        Schema::table('venta', function (Blueprint $table) {
            // Cambiar nombre o agregar nuevas columnas
            $table->date('fecha')->nullable()->change();
            $table->string('metodo_pago', 50)->nullable(); // Agrega columna metodo_pago
            $table->decimal('total', 10, 2)->change(); // Si se requiere modificar el tamaño
        });
    }

    public function down()
    {
        // Revertir los cambios
        Schema::rename('venta', 'pedidos');

        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn('metodo_pago'); // Elimina la columna metodo_pago si existía
            $table->decimal('total', 8, 2)->change(); // Revertir a su tamaño original
        });
    }
};
