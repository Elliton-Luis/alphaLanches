<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['customer_id', 'saleDate', 'value'];

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function saleProducts()
    {
        return $this->hasMany(SaleProduct::class);
    }
}
