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
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * A basic "login" function for the API which
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