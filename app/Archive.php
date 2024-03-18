<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    //
    public function category(){
        return $this->belongsTo('App\Category' ,'category_id');
    }

    public function group(){
        return $this->belongsTo('App\Group' ,'group_id');
    }

    public function files()
    {
        return $this->hasMany('App\ArchiveFile' , 'archive_id');
    }
}
