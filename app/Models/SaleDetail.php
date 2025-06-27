<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    public $timestamps = false;
    protected $table   = 'sale_details';

    protected $fillable = ['sale_id', 'product_id', 'quantity', 'price'];

    /* === Relaciones === */
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
