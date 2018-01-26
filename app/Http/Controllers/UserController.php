<?php

namespace App\Http\Controllers;

use App\Image;
use App\Review;
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

    public function viewUser($id = null)
    {
        $viewUser = User::with('items')->find($id); // FIND SEARCHED USER (This is who the profile belongs to)
        $user = User::find(Auth::id()); // CURRENT LOGGED IN USER
        $canReview = (User::find(Auth::id())->id != $id); // CHECK IF SEARCHED USER IS LOGGED IN (Only show review button if profile does not belong to user)
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

        return view('user.view', ['user' => $user, 'viewUser' => $viewUser, 'canReview' => $canReview, 'userReviews' => $userReviews, 'avgRating' => $avgRating]);
    }

    public function createReview($id = null, Request $request)
    {
        $viewUser = User::find($id); // FIND SEARCHED USER
        $user = User::find(Auth::id()); // CURRENT LOGGED IN USER

        $request->validate([
//            'seller_id' => 'required|exists:users,id',
//            'buyer_id' => 'required|exists:users,id',
            'review' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $review = new Review();
        $review->seller_id = $viewUser->id;
        $review->buyer_id = $user->id;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();

        return redirect()->action('UserController@viewUser', ['id' => $id]);
    }
}
