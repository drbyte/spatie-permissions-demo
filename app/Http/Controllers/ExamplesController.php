<?php

namespace App\Http\Controllers;

use \App\Models\User;
use Illuminate\Http\Request;

class ExamplesController extends Controller
{
    public function show_my_roles()
    {
//        $user = auth()->user();
//        or
        $user = User::first();
        $roles = $user->getRoleNames();

        return var_export($roles, true);

// output:
/**
        Collection {
          #items: array:1 [
            0 => "writer"
          ]
        }
 */
    }
}
