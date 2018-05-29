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
  * Get the projects of the user
  */
  public function publicProjects() {
    return $this->belongsToMany('\App\Model\Project', 'joined', 'iduser', 'idproject');
  }

  public function projects(){
    return $this->belongsToMany('\App\Model\Project', 'joined', 'iduser', 'idproject')->orderBy('lasteditdate', 'DESC');
  }

  public function country(){
    return $this->belongsTo('App\Model\Country', 'idcountry');
  }

  /*
  public function setPasswordAttribute($password){
    $this->attributes['password'] = $password;
  }*/

  /**
  * Get the assigned tasks of the user for a project
  */
  public function assignedTasksForProject($idproject) {
    return $this->belongsToMany('\App\Model\Task', 'assigned', 'iduser', 'idtask')->where('idproject', '=', $idproject);
  }

  /**
  * Get all user tasks, created by him
  */
  public function tasks(){
    return $this->hasMany('App\Model\Task', 'iduser');
  }

  public function assignedTasks(){
    return $this->belongsToMany('\App\Model\Task', 'assigned', 'iduser', 'idtask')->orderBy('lasteditdate', 'DESC');
  }

  public function premiumSignatures(){
    return $this->hasMany('\App\Model\PremiumSignature', 'iduser')->orderBy('startdate', 'ASC');
  }

  public function forumPosts() {
    return $this->hasMany('\App\Model\Post', 'iduser');
  }

  public function comments(){
    return $this->hasMany('App\Model\Comment', 'iduser');
  }

  public function scopeUsernameName($query, $text){
    return $query->where('username', 'ilike', "%{$text}%")->orWhere('name', 'ilike', "%{$text}%");
  }

  /**
   * Get project image.
   */
  public function getPicture(){
      if (file_exists('img/profile/'.$this->iduser.'.png')) {
          return asset('img/profile/'.$this->iduser.'.png');
      } else {
          return asset('img/profile/default.png');
      }
  }
}
