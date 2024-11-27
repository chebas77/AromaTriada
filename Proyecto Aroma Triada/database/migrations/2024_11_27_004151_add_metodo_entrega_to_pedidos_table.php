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
        Schema::table('venta', function (Blueprint $table) {
            $table->string('metodo_entrega')->nullable()->after('total'); // Recogo en tienda / Delivery
            $table->text('direccion_entrega')->nullable()->after('metodo_entrega'); // Dirección completa para Delivery
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('venta', function (Blueprint $table) {
            $table->dropColumn(['metodo_entrega', 'direccion_entrega']);
        });
    }
};
