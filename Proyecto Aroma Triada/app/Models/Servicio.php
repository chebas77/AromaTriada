<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    // Especifica la clave primaria de la tabla si es diferente de 'id'
    protected $primaryKey = 'id_servicio';

    // Otras propiedades del modelo
    protected $fillable = ['nombre', 'descripcion', 'precio', 'imagen', 'id_categoria'];
}
