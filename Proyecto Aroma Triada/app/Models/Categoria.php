<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Especifica la clave primaria si usa un nombre diferente al estándar `id`
    protected $primaryKey = 'id_categoria';

    // Define los atributos que se pueden asignar de manera masiva
    protected $fillable = ['nombre', 'descripcion'];

    /**
     * Relación con los productos.
     * Una categoría puede tener muchos productos.
     */
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria');
    }
    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'id_categoria');
    }

    /**
     * Relación con los servicios (opcional).
     * Si tienes una tabla de servicios relacionada con categorías.
     */
}
