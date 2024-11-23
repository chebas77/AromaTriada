<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Configuración básica del modelo
    protected $table = 'pedidos'; // Tabla pedidos
    protected $primaryKey = 'id_pedido'; // Llave primaria

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'id_usuario', 'total', 'estado', 'fecha_pedido', 'direccion',
    ];

    // Relación con el modelo User (un pedido pertenece a un usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    // Relación con los detalles del pedido
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedido');
    }
///////


    // Método para crear un pedido (opcional)
    public function crearPedido($datos)
    {
        return self::create($datos);
    }

    // Método para actualizar el estado del pedido
    public function actualizarEstado($estado)
    {
        $this->estado = $estado;
        $this->save();
    }
}
