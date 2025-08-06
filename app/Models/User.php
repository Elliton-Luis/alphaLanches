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
    // Alunos que um responsável cadastrou
    public function alunos()
    {
        return $this->belongsToMany(User::class, 'guard_students', 'guard_id', 'student_id');
    }

    // Responsáveis de um aluno
    public function responsaveis()
    {
        return $this->belongsToMany(User::class, 'guard_students', 'student_id', 'guard_id');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function reservedProducts()
    {
        return $this->hasMany(ReservedProduct::class, 'student_id');
    }
}
