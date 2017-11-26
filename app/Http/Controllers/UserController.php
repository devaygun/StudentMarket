<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * UserController constructor.
     *
     * Ensures that the user is authenticated in order to access any functions in this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    /**
     * The update user function allows us to update a user's profile and has backend validation against their input.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'date_of_birth' => 'required|date',
            'profile_picture' => 'image|dimensions:min_width=100,min_height=100,max_width=10000,max_height=10000,size:25000',
            'password' => $request->password ? 'required|string|min:6|confirmed' : '',
        ]);

        $user = User::find(Auth::id());
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;

        if ($request->profile_picture)
            $user->profile_picture = Storage::putFile('profiles', $request->file('profile_picture'));
        if ($request->password)
            $user->password = bcrypt($request->password);
        $user->save();

        $request->session()->flash('success', 'Successfully updated your profile.');

        return view('user.profile', ['user' => $user]);
    }
}
