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

}
