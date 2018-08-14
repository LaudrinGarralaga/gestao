<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model {

    protected $table = 'permission_role';
    protected $fillable = array('permission_id', 'role_id');
    public $timestamps = false;

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function permission() {
        return $this->belongsTo('App\Permission');
    }

}
