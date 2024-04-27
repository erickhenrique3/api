<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtarefas extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'task_id',
        'description',
        'status'

    ];



    public function tarefas()
    {
        return $this->belongsTo(Tarefas::class);
    }
}
