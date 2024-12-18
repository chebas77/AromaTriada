<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'venta'; // Tabla venta
    protected $primaryKey = 'id_pedido';



    protected $fillable = [
        'fecha', 'estado', 'total', 'id_usuario', 'metodo_pago',
        'metodo_entrega', 'direccion_entrega'
    ];
    protected $casts = [
        'fecha' => 'datetime', // Convierte automáticamente el campo `fecha` a una instancia de Carbon
    ];

    /**
     * Relación con el usuario que realizó la venta.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    /**
     * Relación con los detalles de la venta.
     */
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedido');
    }

    /**
     * Relación con el registro de pago de la venta.
     */
    public function pago()
    {
        return $this->hasOne(Pago::class, 'id_pedido', 'id_pedido');
    }

    /**
     * Relación con el tracking de la venta.
     */
    public function tracking()
    {
        return $this->hasOne(Tracking::class, 'id_venta', 'id_pedido');
    }
    
}
