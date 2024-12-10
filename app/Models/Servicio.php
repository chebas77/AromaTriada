<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios'; // Tabla servicios
    protected $primaryKey = 'id_servicio'; // Llave primaria

    protected $fillable = ['nombre', 'descripcion', 'precio', 'disponibilidad', 'tipo_servicio', 'id_categoria'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_servicio', 'id_servicio');
    }
}
