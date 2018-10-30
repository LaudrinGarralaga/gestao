<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = array('name', 'label');
    public $timestamps = false;

    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

}
