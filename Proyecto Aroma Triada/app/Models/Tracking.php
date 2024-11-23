<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Tracking extends Model
{
    use HasFactory;

    protected $table = 'tracking'; // Tabla tracking
    protected $primaryKey = 'id_tracking'; // Llave primaria

    protected $fillable = [
        'id_venta', // Cambiar id_pedido por id_venta
        'origen',
        'destino',
        'estado_actual',
        'fecha_despacho',
        'fecha_entrega',
        'hora_programada',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id_pedido');
    }
}
