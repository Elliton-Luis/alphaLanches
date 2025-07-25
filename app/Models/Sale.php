<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'saleDate', 'scheduled_date', 'value'];

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function saleProducts()
    {
        return $this->hasMany(SaleProduct::class);
    }

    public function reservedProducts()
    {
        return $this->hasMany(ReservedProduct::class);
    }
}
