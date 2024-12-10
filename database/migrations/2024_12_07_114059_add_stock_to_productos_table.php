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
        Schema::table('productos', function (Blueprint $table) {
            $table->integer('stock')->default(0); // Agregar la columna stock
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar la columna 'stock' si revertimos la migración
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('stock');
        });
    }
};
