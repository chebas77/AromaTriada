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
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('id_rol')->unsigned()->default(2)->after('id'); // Agrega la columna
            $table->foreign('id_rol')->references('id_rol')->on('roles')->onDelete('cascade'); // Crea la clave foránea
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_rol']); // Elimina la clave foránea
            $table->dropColumn('id_rol'); // Elimina la columna
        });
    }
};
