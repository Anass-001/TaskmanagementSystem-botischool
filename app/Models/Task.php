<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Champs pouvant être attribués en masse
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'project_id',
        'assigned_user_id' // Changer user_id en assigned_user_id
    ];

    // Conversion automatique des types pour certains attributs
    protected $casts = [
        'end_date' => 'datetime:Y-m-d' // Convertit end_date en objet Carbon
    ];

    // Relation avec le modèle Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relation avec le modèle User pour l'utilisateur assigné
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    // Relation avec le modèle User pour l'utilisateur créateur de la tâche
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->hasMany(TaskReport::class);
    }
}
