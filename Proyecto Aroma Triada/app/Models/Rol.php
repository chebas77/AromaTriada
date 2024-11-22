<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'pedidos'; // Tabla pedidos (o 'ventas' si ya renombraste)
    protected $primaryKey = 'id_pedido'; // Llave primaria

    protected $fillable = ['fecha', 'estado', 'total', 'id_usuario'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedido');
    }

    public function tracking()
    {
        return $this->hasOne(Tracking::class, 'id_pedido', 'id_pedido');
    }

    public function pago()
    {
        return $this->hasOne(Pago::class, 'id_pedido', 'id_pedido');
    }
}
