<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Importa el modelo User

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com', // Cambia este correo si lo prefieres
            'password' => bcrypt('password123'), // Cambia la contraseña si lo necesitas
            'id_rol' => 1, // Asegúrate de que 1 corresponde al rol de Administrador en tu base de datos
        ]);
    }
}
