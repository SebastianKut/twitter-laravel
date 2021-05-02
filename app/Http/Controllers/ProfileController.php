<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        //creates an array with 'variable' => value
        //can pass $variable which has to be na array or 'variable' name as a string
        return view('profiles.show', compact('user'));
    }

    public function edit(User $user)
    {
        //To autorise editing only users profile who is logged in we can use authorise('name of the function in UserPolicy', $user)

        // $this->authorize('edit', $user);

        //Or handle this in the route using middleware
        return view('profiles.edit', compact('user'));
    }
}
