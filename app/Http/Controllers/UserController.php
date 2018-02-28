<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReviewRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Image;
use App\Review;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

/**
 * @resource User
 */
class UserController extends Controller
{
    /**
     * Ensures that the user is authenticated in order to access any functions in this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Individual Profile
     *
     * Returns a user profile based on the `api_token` being used in the request
     */
    public function index(Request $request)
    {
        if ($request->is('api/*'))
            return $this->apiResponse(true, "Successfully retrieved user profile.", User::where('api_token', $request->api_token)->first());

        return view('user.profile', ['user' => Auth::user()]);
    }

    /**
     * Provides a response to API requests in JSON with a consistent formatting
     */
    public function apiResponse($success, $message, $data, $status = 200)
    {
        return response()->json(['success' => $success, 'message' => $message, 'data' => $data], $status);
    }

    /**
     * Update Profile
     *
     * Allows us to update a user's profile and has backend validation against their input
     */
    public function update(UpdateUserRequest $request)
    {
        $id = $request->is('api/*') ? User::where('api_token', $request->api_token)->first()->id : Auth::id(); // Retrieve the user's ID based on if the request is from the API or not
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;

        if ($request->profile_picture)
            $user->profile_picture = Storage::putFile('profiles', $request->file('profile_picture'));
        if ($request->password)
            $user->password = bcrypt($request->password);
        $user->save();

        if ($request->is('api/*'))
            return $this->apiResponse(true, "Successfully updated user profile.", $user);

        $request->session()->flash('success', 'Successfully updated your profile.');

        return view('user.profile', ['user' => $user]);
    }

    /**
     * View User
     *
     * Returns a user account with their reviews and items
     */
    public function viewUser(Request $request, $id = null)
    {
        $current_id = $request->is('api/*') ? User::where('api_token', $request->api_token)->first()->id : Auth::id(); // Retrieve the user's ID based on if the request is from the API or not

        $viewUser = User::with('items')->find($id); // FIND SEARCHED USER (This is who the profile belongs to)
        $user = User::find($current_id); // CURRENT LOGGED IN USER
        $canReview = ($current_id != $id); // CHECK IF SEARCHED USER IS LOGGED IN (Only show review button if profile does not belong to user)
        $userReviews = Review::all()->where('seller_id', $id); // ARRAY OF REVIEWS FOR USER

        // CALCULATE AVERAGE RATING
        $totalRatingValue = 0;
        $numRatings = 0;
        $avgRating = 0;
        foreach ($userReviews as $review) {
            $numRatings ++;
            $totalRatingValue += $review->rating;
        }
        if ($numRatings != 0) $avgRating = number_format(($totalRatingValue / $numRatings), 1);

        if ($request->is('api/*'))
            return $this->apiResponse(true, "Successfully retrieved user view.", ['user' => $user, 'viewUser' => $viewUser, 'canReview' => $canReview, 'userReviews' => $userReviews, 'avgRating' => $avgRating]);


        return view('user.view', ['user' => $user, 'viewUser' => $viewUser, 'canReview' => $canReview, 'userReviews' => $userReviews, 'avgRating' => $avgRating]);
    }

    /**
     * Review
     *
     * Allows for a review to be created
     */
    public function createReview(CreateReviewRequest $request, $id = null)
    {
        $current_id = $request->is('api/*') ? User::where('api_token', $request->api_token)->first()->id : Auth::id(); // Retrieve the user's ID based on if the request is from the API or not

        $viewUser = User::find($id); // FIND SEARCHED USER
        $user = User::find($current_id); // CURRENT LOGGED IN USER


        if ($id == $current_id) // Backend check for a user trying to review themselves
            if ($request->is('api/*')) {
                return $this->apiResponse(false, "You cannot review yourself.", null, 400);
            } else {
                $request->session()->flash('failure', 'You cannot review yourself.');

                return redirect()->action('UserController@viewUser', ['id' => $id]);
            }

        $review = new Review();
        $review->seller_id = $viewUser->id;
        $review->buyer_id = $user->id;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();

        if ($request->is('api/*'))
            return $this->apiResponse(true, "Successfully created review.", null);

        // DISPLAY SUCCESS MESSAGE
        $request->session()->flash('success', 'Successfully added review.');

        return redirect()->action('UserController@viewUser', ['id' => $id]);
    }
}
