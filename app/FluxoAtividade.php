<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FluxoAtividade extends Model
{
    protected $fillable = array('equipe_id', 'user_id', 'atividade');
    protected $table = 'fluxoatividades';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function equipe() {
        return $this->belongsTo('App\Equipe');
    }
}
