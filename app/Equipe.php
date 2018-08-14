<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model {

    protected $fillable = array('nome', 'descricao', 'area_id');
    public $timestamps = false;

    public function area() {
        return $this->belongsTo('App\Area');
    }

}
