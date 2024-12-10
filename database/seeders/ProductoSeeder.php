<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'Torta de Zanahoria',
                'descripcion' => 'Una torta húmeda de zanahoria, cubierta con crema de queso.',
                'precio' => 110.00,
                'imagen' => 'images/torta_zanahoria.png',
                'disponibilidad' => 1,
                'id_categoria' => 1, // Categoria: Tortas
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
