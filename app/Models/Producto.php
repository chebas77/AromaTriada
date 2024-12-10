<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Tabla productos
    protected $primaryKey = 'id_producto'; // Llave primaria

    protected $fillable = ['nombre', 'descripcion', 'precio', 'disponibilidad', 'tipo_producto', 'id_categoria','imagen', 'stock'];
    
    
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_producto', 'id_producto');
    }
    public function scopeAvailable($query)
    {
        return $query->where('disponibilidad', 1);
    }
}
