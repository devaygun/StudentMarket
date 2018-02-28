<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/**
 * @resource Authentication
 *
 * Below you can find methods for logging in and registering.
 *
 * @package App\Http\Controllers
 */
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
     * Login
     *
     * Requires a valid <kbd>email</kbd> and a <kbd>password</kbd>
     *
     * Returns the user
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();

            if ($user->api_token === null) { // If there's no api_token set for the user then one will be generated
                $api_token = str_random(60);
                User::where('email', $request->email)->update(['api_token' => $api_token]);
                $user->api_token = $api_token;
            }

            return $this->response(true, 'Successfully logged in.', $user);
        }

        return $this->response(false, 'Invalid credentials, please try again.', 401);
    }

    /**
     * Registration
     *
     * Also requires a `password_confirmation` input
     *
     * Returns the user
     */
    public function register(RegistrationRequest $request)
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->password = bcrypt($request->password);
        $user->api_token = str_random(60);
        $user->save();

        return $this->response(true, 'Successfully registered.', $user);
    }

    /**
     * Logout
     *
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