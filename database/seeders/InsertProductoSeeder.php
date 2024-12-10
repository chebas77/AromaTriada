<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class InsertProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('productos')->insert([
           
            [
                'nombre' => 'Torta de Manzana',
                'descripcion' => 'Deliciosa torta casera de manzana con canela.',
                'precio' => 95.00,
                'imagen' => 'images/torta_manzana.jpg',
                'disponibilidad' => 1,
                'id_categoria' => 1, // Categoria: Tortas
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Bocadito de Queso Crema',
                'descripcion' => 'Bocaditos rellenos con queso crema suave y una pizca de ajo.',
                'precio' => 45.00,
                'imagen' => 'images/bocadito_queso_crema.jpg',
                'disponibilidad' => 1,
                'id_categoria' => 2, // Categoria: Bocaditos
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Bocaditos de Espinaca',
                'descripcion' => 'Bocaditos saludables rellenos de espinaca y queso.',
                'precio' => 50.00,
                'imagen' => 'images/bocadito_espinaca.jpg',
                'disponibilidad' => 1,
                'id_categoria' => 2, // Categoria: Bocaditos
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Torta de Limón y Merengue',
                'descripcion' => 'Refrescante torta de limón con una capa de merengue suave.',
                'precio' => 120.00,
                'imagen' => 'images/torta_limon_merengue.jpg',
                'disponibilidad' => 1,
                'id_categoria' => 1, // Categoria: Tortas
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Torta de Fresa',
                'descripcion' => 'Torta suave con sabor a fresa y cobertura de crema.',
                'precio' => 100.00,
                'imagen' => 'images/torta_fresa.jpg',
                'disponibilidad' => 1,
                'id_categoria' => 1, // Categoria: Tortas
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cupcakes de Chocolate',
                'descripcion' => 'Deliciosos cupcakes con frosting de chocolate.',
                'precio' => 35.00,
                'imagen' => 'images/cupcakes_chocolate.jpg',
                'disponibilidad' => 1,
                'id_categoria' => 2, // Categoria: Bocaditos
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Torta de Café',
                'descripcion' => 'Una torta con suave sabor a café y cubierta de crema batida.',
                'precio' => 115.00,
                'imagen' => 'images/torta_cafe.jpg',
                'disponibilidad' => 1,
                'id_categoria' => 1, // Categoria: Tortas
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Torta de Chocolate Blanco',
                'descripcion' => 'Torta suave de chocolate blanco con un toque de frambuesas.',
                'precio' => 125.00,
                'imagen' => 'images/torta_chocolate_blanco.jpg',
                'disponibilidad' => 1,
                'id_categoria' => 1, // Categoria: Tortas
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Mini Box de Tortas',
                'descripcion' => 'Paquete pequeño con una selección de mini tortas.',
                'precio' => 150.00,
                'imagen' => 'images/mini_box_tortas.jpg',
                'disponibilidad' => 1,
                'id_categoria' => 3, // Categoria: Boxes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Mini Box de Bocaditos',
                'descripcion' => 'Caja con una selección variada de bocaditos pequeños.',
                'precio' => 120.00,
                'imagen' => 'images/mini_box_bocaditos.jpg',
                'disponibilidad' => 1,
                'id_categoria' => 3, // Categoria: Boxes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Torta de Mango',
                'descripcion' => 'Torta fresca con un toque tropical de mango.',
                'precio' => 105.00,
                'imagen' => 'images/torta_mango.jpg',
                'disponibilidad' => 1,
                'id_categoria' => 1, // Categoria: Tortas
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Box Mix de Tortas y Bocaditos',
                'descripcion' => 'Caja mixta con tortas y bocaditos para compartir en fiestas.',
                'precio' => 200.00,
                'imagen' => 'images/box_mixto.jpg',
                'disponibilidad' => 1,
                'id_categoria' => 3, // Categoria: Boxes
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}