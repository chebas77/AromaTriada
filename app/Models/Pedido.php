<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'pedidos'; // Nombre de la tabla

    /**
     * La llave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id_pedido'; // Llave primaria personalizada

    /**
     * Campos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_usuario',
        'fecha',
        'estado',
        'total',
        'metodo_pago', // Incluye nuevos campos según la estructura de la tabla si corresponde
    ];

    /**
     * Relación: Un pedido pertenece a un usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id'); // Relación con la tabla 'users'
    }

    /**
     * Relación: Un pedido tiene muchos detalles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedido'); // Relación con la tabla 'detalles_pedido'
    }

    /**
     * Atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha' => 'date',
        'total' => 'decimal:2',
    ];

    /**
     * Obtiene el estado formateado para visualización.
     *
     * @return string
     */
    public function obtenerEstadoFormateado(): string
    {
        $estados = [
            'En proceso' => 'En proceso',
            'Enviado' => 'Enviado',
            'Entregado' => 'Entregado',
            'Cancelado' => 'Cancelado',
        ];

        return $estados[$this->estado] ?? 'Desconocido';
    }
}
