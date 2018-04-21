<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
     */
    public function publicProjects() {
        return $this->belongsToMany('\App\Model\Project', 'joined', 'iduser', 'idproject');
    }
}
