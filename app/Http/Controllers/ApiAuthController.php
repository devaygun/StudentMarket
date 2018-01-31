<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ApiAuthController extends Controller
{
    /**
     * Applies the API authentication middleware which checks that a valid api_token exists
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Login function with validation and upon success returns the authenticated user object
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();

            return $this->response(true, 'Successfully logged in.', $user);
        }

        return $this->response(false, 'Invalid credentials, please try again.', 401);
    }

    /**
     * Registration function
     */
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'date_of_birth' => 'required|date',
            'profile_picture' => 'image|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->password = bcrypt($request->password);
        $user->save();

        return $this->response(true, 'Successfully registered.', $user);
    }

    /**
     * Logs out the user, invalidates and refreshes the API token
     */
    public function logout()
    {
        $user = User::find(Auth::id());
        $user->api_token = str_random(60);
        $user->save();

        auth()->logout();

        return $this->response(true, 'Successfully logged out.', null);
    }

    /**
     * Other functions will utilise this function to create formatted responses
     */
    public function response($success, $message, $data, $status = 200)
    {
        return response()->json(['success' => $success, 'message' => $message, 'data' => $data], $status);
    }
}