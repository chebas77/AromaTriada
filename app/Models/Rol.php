<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
{
    use HasFactory;

    // Configuración actualizada para la tabla roles
    protected $table = 'roles'; // Nombre de la tabla
    protected $primaryKey = 'id_rol'; // Llave primaria es 'id_rol'
    public $incrementing = true; // Indica que la llave primaria es incremental
    protected $keyType = 'int'; // Tipo de dato de la llave primaria

    protected $fillable = ['nombre', 'descripcion']; // Campos que se pueden asignar masivamente

    // Relación con usuarios
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_rol', 'id_rol'); // Relación ajustada para usar 'id_rol'
    }

    // Funciones adicionales para verificar roles específicos
    public function esAdministrador(): bool
    {
        return $this->nombre === 'Administrador';
    }

    public function esUsuario(): bool
    {
        return $this->nombre === 'Usuario';
    }
}
