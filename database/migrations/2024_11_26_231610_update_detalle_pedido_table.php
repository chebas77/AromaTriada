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
        Schema::table('detalle_pedidos', function (Blueprint $table) {
            // Renombrar la columna 'personalizacion' a 'dedicatoria' si existe
            if (Schema::hasColumn('detalle_pedidos', 'personalizacion')) {
                $table->renameColumn('personalizacion', 'dedicatoria');
            }

            // Agregar la columna 'tamano' si no existe
            if (!Schema::hasColumn('detalle_pedidos', 'tamañ    o')) {
                $table->string('tamaño')->nullable()->after('dedicatoria');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_pedidos', function (Blueprint $table) {
            // Revertir el cambio de nombre de 'dedicatoria' a 'personalizacion'
            if (Schema::hasColumn('detalle_pedidos', 'dedicatoria')) {
                $table->renameColumn('dedicatoria', 'personalizacion');
            }

            // Eliminar la columna 'tamano' si existe
            if (Schema::hasColumn('detalle_pedidos', 'tamaño')) {
                $table->dropColumn('tamaño');
            }
        });
    }
};
