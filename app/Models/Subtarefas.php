<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtarefas extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'tarefa_id',
        'description',
        'status'

    ];



    public function subtarefas()
    {
        return $this->hasMany(Subtarefas::class);
    }
}
