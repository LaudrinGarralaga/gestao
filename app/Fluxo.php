<?php

namespace App;

use App\Equipe;
use Illuminate\Database\Eloquent\Model;

class Fluxo extends Model
{

    protected $fillable = array('descricao');
    public $timestamps = false;

    public function equipe()
    {
        return $this->belongsTo('App\Equipe');
    }

    public function notificacao()
    {
        return $this->HasMany('App\Notificacao');
    }

}
