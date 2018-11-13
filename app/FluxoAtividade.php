<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FluxoAtividade extends Model
{
    protected $fillable = array('equipe_id', 'fluxo_id', 'precedencia', 'finalizado');
    protected $table = 'fluxoatividades';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function equipe()
    {
        return $this->belongsTo('App\Equipe');
    }

    public function fluxo()
    {
        return $this->belongsTo('App\Fluxo');
    }

    public function notificacao()
    {
        return $this->HasMany('App\Notificacao');
    }

}
