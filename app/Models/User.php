<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_role', // Inclure le champ is_role
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the teams that the user belongs to.
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    /**
     * Get the team that the user manages.
     */
    public function managedTeam()
    {
        return $this->hasOne(Team::class, 'manager_id');
    }
    /**
     * Check if the user is a regular user.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->is_role === 2;
    }

    /**
     * Check if the user is a manager.
     *
     * @return bool
     */
    public function isManager()
    {
        return $this->is_role == 1;
    }


    /**
     * Check if the user is a regular user.
     *
     * @return bool
     */
    public function isUser()
    {
        return $this->is_role === 0;
    }


    /**
     * Get the tasks assigned to the user.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_user_id');
    }
}
