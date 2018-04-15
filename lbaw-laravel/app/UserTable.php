<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTable extends Model {
    /**
     * The table associated with the model.
     */
    protected $table = 'usertable';

    protected $primaryKey = 'iduser';
}