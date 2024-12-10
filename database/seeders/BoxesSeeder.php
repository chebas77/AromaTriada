<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BoxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Insertar boxes de ejemplo
         DB::table('productos')->insert([
            [
                'nombre' => 'Box Fiesta',
                'descripcion' => 'Box Fiesta con decoraciones y snacks',
                'precio' => 300.00,
                'imagen' => 'images/box_fiesta.png',
                'id_categoria' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Box Familiar',
                'descripcion' => 'Box Familiar con opciones para todos',
                'precio' => 250.00,
                'imagen' => 'images/box_familiar.png',
                'id_categoria' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
