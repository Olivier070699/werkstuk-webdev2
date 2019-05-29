<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsOverview extends Model
{
    protected $table = 'news_overview';
    protected $fillable = [
      'project_id', 
      'title',
      'intro',
    ];
}
