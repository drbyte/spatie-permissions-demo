<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamplesController extends Controller
{
    public function show_my_roles()
    {
//        $user = auth()->user();
        $user = \App\User::find(1);
        $roles = $user->getRoleNames();

        dd($roles);

        // output:
        /**
        Collection {#619 ▼
          #items: array:1 [▼
            0 => "writer"
          ]
        }
         */
    }
}
