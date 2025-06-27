<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    protected $hidden   = ['password', 'remember_token'];

    /* === Relaciones === */
    public function sales()
    {
        // El usuario puede ser ‘usuario’ o ‘cajero’; buyer_type lo deja claro
        return $this->hasMany(Sale::class, 'buyer_id');
    }

    /* === Helpers === */
    public function isAdmin()  { return $this->role === 'administrador'; }
    public function isCashier(){ return $this->role === 'cajero'; }
}
