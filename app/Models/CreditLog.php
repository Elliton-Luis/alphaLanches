<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditLog extends Model
{
    protected $fillable = ['user_id', 'valor', 'tipo', 'metodo_pagamento', 'executado_por'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function executor()
    {
        return $this->belongsTo(User::class, 'executado_por');
    }
}