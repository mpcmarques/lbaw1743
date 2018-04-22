<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    
    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
    * The table associated with the model.
    */
    protected $table = 'usertable';
    
    /*
    *   Primary key
    */
    protected $primaryKey = 'iduser';
    
    /**
    * Get the public projects of the user
    * TODO: check if the project is public before showing it
    */
    public function publicProjects() {
        return $this->belongsToMany('\App\Model\Project', 'joined', 'iduser', 'idproject');
    }

    public function projects(){
        return $this->belongsToMany('\App\Model\Project', 'joined', 'iduser', 'idproject');
    }
    
    public function setPasswordAttribute($password){
        $this->attributes['password'] = $password;
    }
    /**
     * Get the assigned tasks of the user for a project
     */
    public function assignedTasksForProject($idproject) {
        return $this->belongsToMany('\App\Model\Task', 'assigned', 'idtask', 'iduser');
    }
}
