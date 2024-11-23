<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id_rol' => 1,
                'nombre' => 'Administrador',
                'descripcion' => 'Acceso completo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_rol' => 2,
                'nombre' => 'Usuario',
                'descripcion' => 'Acceso Limitado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}