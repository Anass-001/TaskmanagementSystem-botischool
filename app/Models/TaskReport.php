<?php

// TaskReport.php (Modèle TaskReport)

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskReport extends Model
{
    // Champs pouvant être attribués en masse
    protected $fillable = [
        'content',
        'task_id',
        'user_id',
    ];

    // Relation avec le modèle Task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Relation avec le modèle User pour l'utilisateur qui a soumis le rapport
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
