<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $fillable = array('user_id','atividade_id', 'visto');
    protected $table = 'notificacoes';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function fluxo()
    {
        return $this->belongsTo('App\Fluxo');
    }
    public function equipe()
    {
        return $this->belongsTo('App\Equipe');
    }
}
