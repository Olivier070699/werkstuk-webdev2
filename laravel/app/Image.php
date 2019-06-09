<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'project_id',
        'filepath',
        'filename',
    ];

    public function product(){
        return $this->hasOne('\App\Project');
    }
}
