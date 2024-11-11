<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Define la clave primaria y los campos asignables
    protected $primaryKey = 'id_producto';
    protected $fillable = ['nombre', 'descripcion', 'precio', 'imagen', 'disponibilidad', 'tipo_producto', 'id_categoria'];

    /**
     * Relación con la categoría.
     * Un producto pertenece a una categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
