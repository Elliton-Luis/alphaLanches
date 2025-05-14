<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name', 'describe', 'price', 'type', 'amount'];
    public function saleProducts()
    {
        return $this->hasMany(SaleProduct::class);
    }

    public function getTipoTraduzidoAttribute()
    {
        return match ($this->type) {
            'drink' => 'Bebida',
            'savory' => 'Salgado',
            'lunch' => 'Almoço',
            'snacks' => 'Lanches',
            'natural' => 'Natural',
            default => 'Desconhecido',
        };
    }
}