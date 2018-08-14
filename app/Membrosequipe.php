<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membrosequipe extends Model
{
    protected $fillable = array('responsavel', 'user_id', 'equipe_id');
    public $timestamps = false;

    public function equipe() {
        return $this->belongsTo('App\Equipe');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
}
