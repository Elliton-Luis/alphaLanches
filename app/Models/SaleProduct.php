<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    protected $fillable = ['sale_id', 'product_id', 'productQuantity'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Produto::class);
    }
}
