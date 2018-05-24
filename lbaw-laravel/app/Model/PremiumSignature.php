<?php

namespace App\Model;

use App\Model\BaseModel;

class PremiumSignature extends BaseModel
{
  function __construct(){
    parent::__construct('premiumsignature', 'idpremium');
  }

  function user(){
    return $this->belongsTo('App\Model\User', 'iduser');
  }
}
