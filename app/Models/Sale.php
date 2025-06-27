<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    public $timestamps = false; // No usamos created_at / updated_at
    protected $fillable = ['buyer_id', 'buyer_type', 'sale_date'];

    /* === Relaciones === */
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(SaleDetail::class);
    }

    /* === Accesor total de la venta === */
    public function getTotalAttribute(): float
    {
        return $this->details->sum(fn($d) => $d->price * $d->quantity);
    }
}
