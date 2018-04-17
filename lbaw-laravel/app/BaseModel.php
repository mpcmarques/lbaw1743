<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model {
  // Don't add create and update timestamps in database.
  public $timestamps = false;
  /**
  * The table associated with the model.
  */
  protected $table;
  /* 
  *   Primary key
  */
  protected $primaryKey;
  
  function __construct($table, $key){
    $this->table = $table;
    $this->primaryKey = $key;
  }
}
