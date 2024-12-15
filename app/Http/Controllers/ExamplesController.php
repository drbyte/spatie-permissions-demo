<?php

namespace App\Http\Controllers;

use \App\Models\User;
use Illuminate\Http\Request;

class ExamplesController extends Controller
{
    public function show_my_roles()
    {
        $user = auth()->user();
        $roles = $user->getRoleNames();

        return dd($roles);

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
