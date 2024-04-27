<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tarefas extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',

        'description',
        'due_date',
        'status'

    ];

    public function subtarefas()
    {
        return $this->hasMany(Subtarefas::class, 'task_id');
        
    }


    
}
