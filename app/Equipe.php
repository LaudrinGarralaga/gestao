<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model {

    protected $fillable = array('nome', 'descricao', 'area_id', 'user_id');
    public $timestamps = false;

    public function area() {
        return $this->belongsTo('App\Area');
    }

    public function membros(){
        return $this->hasMany('App\Membrosequipe');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function equipe() {
        return $this->belongsTo('App\Equipe');
    }

}
