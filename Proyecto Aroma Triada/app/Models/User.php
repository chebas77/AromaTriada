<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    protected $table = 'users'; // Nombre de la tabla
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
        'id_rol', // Relación con roles
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
     * Atributos que deben ser convertidos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación: un usuario pertenece a un rol.
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol'); // Relación con 'roles.id_rol'
    }

    /**
     * Relación: un usuario puede tener muchos pedidos.
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_usuario', 'id');
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
