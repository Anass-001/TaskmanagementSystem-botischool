<?php



// app/Models/Team.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'manager_id'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function projects()
    {

        return $this->belongsToMany(Project::class, 'project_team');
    }
    public function members()
    {
        return $this->hasMany(User::class, 'team_id');
    }
    public function isEmpty()
    {
        return count((array)$this->hasMany(User::class, 'team_id'));
    }
}
