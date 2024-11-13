<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_producto';

    // Consolidamos los campos de fillable en una sola declaración
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'disponibilidad',
        'tipo_producto',
        'id_categoria'
    ];

    /**
     * Relación con la categoría.
     * Un producto pertenece a una categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
