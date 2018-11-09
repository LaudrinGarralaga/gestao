<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membrosequipe extends Model
{
    protected $fillable = array('user_id', 'equipe_id', 'visto');
    protected $table = 'membrosequipes';
    public $timestamps = false;

    public function equipe()
    {
        return $this->HasMany('App\Equipe');
    }
    public function user()
    {
        return $this->HasMany('App\User');
    }
}
