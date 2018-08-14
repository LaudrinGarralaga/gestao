<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Role;
use App\User;
use App\Permission;
use App\Fluxo;
use App\Area;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $totalUsers = User::count();
        $totalRoles = Role::count();
        $totalPermissions = Permission::count();
        $totalFluxos = Fluxo::count();
        $totalAreas = Area::count();

        return view('home', compact('totalUsers', 'totalRoles', 'totalPermissions', 'totalFluxos', 'totalAreas'));
    }

    public function rolesPermissions() {

        $nameSuser = auth()->user()->name;

        echo("<h1>{$nameSuser}</h1>");

        foreach (auth()->user()->roles as $role) {
            echo "<b>$role->name</b> -> ";

            $permissions = $role->permissions;
            foreach ($permissions as $permission) {
                echo " $permission->name , ";
            }
            echo '<hr>';
        }
    }

}
