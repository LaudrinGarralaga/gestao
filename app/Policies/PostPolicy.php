<?php

namespace App\Policies;

use App\User;
use App\Area;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy {

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function updateArea(User $user, Area $area) {

        return $user->id == $area->user_id;
    }
    
    public function before(User $user){
        
        return $user->name == 'admin';
    }

}
