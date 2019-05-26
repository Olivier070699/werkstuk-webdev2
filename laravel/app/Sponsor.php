<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $table = 'sponsor';
    protected $fillable = [
      'projects_id',
      'user_id',
      'credits',  
    ];
}
