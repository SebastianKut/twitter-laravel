<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function update(User $user)
    {
        $data = request()->validate([
            'name'          => ['string', 'required', 'max:255'],
            'username'      => ['string', 'required', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user)], //ignore current user because otherwise it will always fail validation when we dnt want to change username
            'email'         => ['string', 'required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'avatar'        => ['file'],
            'password'      => ['string', 'required', 'min:8', 'max:255', 'confirmed'],
        ]);

        $data['avatar'] = request('avatar')->store('avatars'); //this calls the laravel method from request called store and we pass location folder to the function.
        //This store function stores a file and returns a path where the image is stored (the path then can be saved to database)
        $user->update($data);
        return redirect(route('profile', $user->username));
    }
}
