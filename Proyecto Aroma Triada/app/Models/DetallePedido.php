<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedidos'; // Tabla detalle_pedidos
    protected $primaryKey = 'id_detalle'; // Llave primaria

    protected $fillable = [
        'id_pedido',
        'id_producto',
        'id_servicio',
        'cantidad',
        'precio_unitario',
        'dedicatoria', // Campo renombrado
        'tamaño',      // Nuevo campo
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_pedido', 'id_pedido');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio', 'id_servicio');
    }
}
