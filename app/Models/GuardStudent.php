<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardStudent extends Model
{
    use HasFactory;

    protected $table = 'guard_students';

    protected $fillable = ['guard_id', 'student_id'];

    public function responsavel()
    {
        return $this->belongsTo(User::class, 'guard_id');
    }

    public function estudante()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}