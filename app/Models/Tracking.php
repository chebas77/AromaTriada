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
        'id_venta', // Clave foránea hacia venta
        'origen',
        'destino',
        'estado_actual',
        'fecha_despacho',
        'fecha_entrega',
        'hora_programada',
    ];

    protected $casts = [
        'fecha_despacho' => 'datetime',
        'fecha_entrega' => 'datetime',
    ];

    const ESTADOS = ['Preparando envío','En proceso', 'Enviado', 'Entregado', 'Cancelado'];

    public function setEstadoActualAttribute($value)
    {
        if (!in_array($value, self::ESTADOS)) {
            throw new \InvalidArgumentException("Estado no válido.");
        }
        $this->attributes['estado_actual'] = $value;
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id_pedido');
    }
}