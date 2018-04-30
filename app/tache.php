<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tache extends Model
{
  protected $fillable = [
      'termine',
  ];
    public $timestamps = true;
}
