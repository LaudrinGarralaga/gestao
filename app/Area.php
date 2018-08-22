<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model {

    protected $fillable = array('descricao', 'sigla');
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User');
    }

}
