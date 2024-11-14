<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
class ProductosYServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Insertar productos de ejemplo si la tabla está vacía
        DB::table('productos')->insert([
            [
                'nombre' => 'Torta de Tres Leches',
                'descripcion' => 'Torta de Tres Leches',
                'precio' => 125.00,
                'id_categoria' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Alfajores de Maicena',
                'descripcion' => 'Alfajores de Maicena rellenos con manjar blanco',
                'precio' => 75.00,
                'id_categoria' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    

    // Insertar servicios de ejemplo si la tabla está vacía

        DB::table('servicios')->insert([
            [
                'nombre' => 'Maestro de Ceremonia',
                'descripcion' => 'Implementación de un Maestro de Ceremonia para presentacion de servicios',
                'precio' => 200.00,
                'id_categoria' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Delivery',
                'descripcion' => 'Implementación de un personal que realizara el envio al lugar del evento ',
                'precio' => 80.00,
                'id_categoria' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
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