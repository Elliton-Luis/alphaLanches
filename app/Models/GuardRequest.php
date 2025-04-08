<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuardRequest extends Model
{
    protected $table = 'GuardRequests';
    protected $fillable = [
        'name',
        'email',
        'telefone',
        'cpf'
    ];
}
