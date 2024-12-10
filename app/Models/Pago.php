<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos'; // Tabla pagos
    protected $primaryKey = 'id_pago'; // Llave primaria

    protected $fillable = ['id_pedido', 'fecha_pago', 'monto', 'estado', 'metodo'];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_pedido', 'id_pedido');
    }
}
