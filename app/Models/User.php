<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'telefone',
        'cpf',
        'credit',
        'profile_picture'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getTipoTraduzidoAttribute()
    {
        return match ($this->type) {
            'guard' => 'Responsável',
            'student' => 'Estudante',
            'func' => 'Funcionário',
            'admin' => 'Administrador',
            default => ucfirst($this->type),
        };
    }
    public function responsavel()
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }
    public function dependentes()
    {
        return $this->hasMany(User::class, 'responsavel_id');
    }
}
