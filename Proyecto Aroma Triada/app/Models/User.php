<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, HasTeams, Notifiable, TwoFactorAuthenticatable;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'users'; // Nombre de la tabla

    /**
     * La llave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id'; // Llave primaria (por defecto en Laravel es "id")

    /**
     * Campos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_rol', // Campo que relaciona al rol
    ];

    /**
     * Campos que se deben ocultar al serializar.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * Atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Atributos adicionales que se agregarán a la representación del modelo.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Relación: Un usuario pertenece a un rol.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol'); // Relación con la tabla 'roles'
    }

    /**
     * Relación: Un usuario tiene muchos pedidos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_usuario', 'id'); // Relación con la tabla 'pedidos'
    }

    /**
     * Verifica si el usuario tiene el rol de Administrador.
     *
     * @return bool
     */
    public function esAdministrador(): bool
    {
        return $this->rol && $this->rol->nombre === 'Administrador';
    }

    /**
     * Verifica si el usuario tiene un rol específico.
     *
     * @param string $nombreRol
     * @return bool
     */
    public function tieneRol(string $nombreRol): bool
    {
        return $this->rol && $this->rol->nombre === $nombreRol;
    }
}
