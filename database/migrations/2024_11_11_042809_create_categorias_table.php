<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crear la tabla categorias
        Schema::create('categorias', function (Blueprint $table) {
            $table->id('id_categoria'); // Primary Key
            $table->string('nombre', 50)->unique();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        // Insertar categorías iniciales
        DB::table('categorias')->insert([
            ['nombre' => 'Tortas', 'descripcion' => 'Categoría de tortas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Bocaditos', 'descripcion' => 'Categoría de bocaditos', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Boxes', 'descripcion' => 'Categoría de boxes', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Servicios', 'descripcion' => 'Categoría de servicios', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Agregar columna id_categoria a la tabla productos y establecer la relación
        Schema::table('productos', function (Blueprint $table) {
            $table->foreignId('id_categoria')
                  ->nullable()
                  ->constrained('categorias', 'id_categoria')
                  ->onDelete('set null');
        });

        // Agregar columna id_categoria a la tabla servicios y establecer la relación
        Schema::table('servicios', function (Blueprint $table) {
            $table->foreignId('id_categoria')
                  ->nullable()
                  ->constrained('categorias', 'id_categoria')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar las relaciones en productos y servicios
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign(['id_categoria']);
            $table->dropColumn('id_categoria');
        });

        Schema::table('servicios', function (Blueprint $table) {
            $table->dropForeign(['id_categoria']);
            $table->dropColumn('id_categoria');
        });

        // Eliminar la tabla categorias
        Schema::dropIfExists('categorias');
    }
};
