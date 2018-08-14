<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller {

    public function index() {

        $users = User::paginate(5);
        return view('listas.user_list', compact('users'));
    }

    public function destroy($id) {
        $user = User::find($id);
        if ($user->delete()) {
            return redirect()->route('users.index')
                            ->with('status', $user->name . ' Excluído!');
        }
    }

}
