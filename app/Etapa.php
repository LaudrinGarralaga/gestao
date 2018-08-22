<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model {

    protected $fillable = array('procedencia', 'area_id', 'fluxo_id');
    public $timestamps = false;

    public function area() {
        return $this->belongsTo('App\Area');
    }

    public function fluxo() {
        return $this->belongsTo('App\Fluxo');
    }

}
