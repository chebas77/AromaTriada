<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias'; // Tabla categorias
    protected $primaryKey = 'id_categoria'; // Llave primaria

    protected $fillable = ['nombre', 'descripcion'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria', 'id_categoria');
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'id_categoria', 'id_categoria');
    }
}
