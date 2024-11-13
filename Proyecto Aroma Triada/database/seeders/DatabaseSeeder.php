<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Verificar si el usuario con el email 'test@example.com' existe antes de crearlo
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->withPersonalTeam()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'), // asegúrate de especificar la contraseña
            ]);
        }

        // Insertar categorías iniciales si la tabla está vacía
        if (DB::table('categorias')->count() == 0) {
            DB::table('categorias')->insert([
                ['nombre' => 'Tortas', 'descripcion' => 'Categoría de tortas', 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Bocaditos', 'descripcion' => 'Categoría de bocaditos', 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Boxes', 'descripcion' => 'Categoría de boxes', 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Servicios', 'descripcion' => 'Categoría de servicios', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        // Insertar productos de ejemplo si la tabla está vacía
        if (DB::table('productos')->count() == 0) {
            DB::table('productos')->insert([
                ['nombre' => 'Torta de Chocolate', 'descripcion' => 'Torta de Chocolate ', 'precio' => 100.00, 'id_categoria' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Petit Pan de Pollo', 'descripcion' => 'Panes tipo Petit Pan rellenos de Pollo con crema', 'precio' => 150.00, 'id_categoria' => 2, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        // Insertar servicios de ejemplo si la tabla está vacía
        if (DB::table('servicios')->count() == 0) {
            DB::table('servicios')->insert([
                ['nombre' => 'Mozo', 'descripcion' => 'Implementacion de un mozo para la realizacion del evento programado', 'precio' => 200.00, 'id_categoria' => 4, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Decoracion', 'descripcion' => 'Implementacion de un personal adecuado que se encargue de un mejor aspecto al evento', 'precio' => 250.00, 'id_categoria' => 4, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
        $this->call(ProductosYServiciosSeeder::class);
    }
}
