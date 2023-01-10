<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;
use App\Models\Outfit;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    function index()
    {
        $user = Auth::user(); // get currently logged in user
        $user_id = $user->id; // get the user's id
        $username = $user->name;
        $email = $user->email;
  
       $data = Outfit::where('user_id', $user_id)->latest()->paginate(50);
    //  $data = Outfit::latest()->paginate(5);
     return view('account', compact('data'))
       ->with('i', (request()->input('page', 1) - 1) * 5)->with(compact('email'))->with(compact('username'));
    }


    function fetch_inner($innerwear)
    {
        $user = Auth::user(); // get currently logged in user
        $user_id = $user->id; // get the user's id

        $innerwear_image = Images::where('id', $innerwear)
        ->where('user_id', $user_id)
        ->firstOrFail();
       
        $image_file = Image::make($innerwear_image->user_image);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }

    function fetch_outter($outterwear)
    {
        $user = Auth::user(); // get currently logged in user
        $user_id = $user->id; // get the user's id

        $outterwear_image = Images::where('id', $outterwear)
        ->where('user_id', $user_id)
        ->firstOrFail();
       
        $image_file = Image::make($outterwear_image->user_image);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }

    function fetch_bottom($bottom)
    {
        $user = Auth::user(); // get currently logged in user
        $user_id = $user->id; // get the user's id

        $bottom_image = Images::where('id', $bottom)
        ->where('user_id', $user_id)
        ->firstOrFail();
       
        $image_file = Image::make($bottom_image->user_image);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }

    function fetch_shoes($shoes)
    {
        $user = Auth::user(); // get currently logged in user
        $user_id = $user->id; // get the user's id

        $shoes_image = Images::where('id', $shoes)
        ->where('user_id', $user_id)
        ->firstOrFail();
       
        $image_file = Image::make($shoes_image->user_image);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }

    function get_other_account(Request $request){
        $logged_user = Auth::user(); // get currently logged in user
        $logged_user_name = $logged_user->name; // get the user's id
        $user_id = $request->user_id;
        $user = User::where('id', '=', $user_id) ->get();
        $user_id = $user->value('id'); // get the user's id
        $username = $user->value('name');
        $email = $user->value('email');
  
       $data = Outfit::where('user_id', $user_id)->latest()->paginate(50);
        //  $data = Outfit::latest()->paginate(5);
        return view('account_social', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5)->with(compact('email'))->with(compact('username'))->with(compact('user_id'))->with(compact('logged_user_name'));
    }
    public function delete_outfit($outfit_id){
        Outfit::where('id', $outfit_id)->delete();
        return redirect()->back()->with('success', 'Outfit deleted');
      }
    function get_social_page()
    {
        $user = Auth::id();
        $logged_in_user = Auth::user();
        $username = $logged_in_user->name;
        $social_data = User::where('id', '!=', $user) ->get();
        return view('social')->with(compact('social_data'))->with(compact('username'));
    }

    function social_fetch_inner($innerwear, $user_id)
    {
        // $user = Auth::user(); // get currently logged in user
        // $user_id = $user->id; // get the user's id

        $innerwear_image = Images::where('id', $innerwear)
        ->where('user_id', $user_id)
        ->firstOrFail();
       
        $image_file = Image::make($innerwear_image->user_image);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }

    function social_fetch_outter($outterwear, $user_id)
    {
        // $user = Auth::user(); // get currently logged in user
        // $user_id = $user->id; // get the user's id

        $outterwear_image = Images::where('id', $outterwear)
        ->where('user_id', $user_id)
        ->firstOrFail();
       
        $image_file = Image::make($outterwear_image->user_image);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }

    function social_fetch_bottom($bottom, $user_id)
    {
        // $user = Auth::user(); // get currently logged in user
        // $user_id = $user->id; // get the user's id

        $bottom_image = Images::where('id', $bottom)
        ->where('user_id', $user_id)
        ->firstOrFail();
       
        $image_file = Image::make($bottom_image->user_image);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }

    function social_fetch_shoes($shoes, $user_id)
    {
        // $user = Auth::user(); // get currently logged in user
        // $user_id = $user->id; // get the user's id

        $shoes_image = Images::where('id', $shoes)
        ->where('user_id', $user_id)
        ->firstOrFail();
       
        $image_file = Image::make($shoes_image->user_image);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }

    public function search_user(Request $request) {
        $user = Auth::user(); // get currently logged in user
        $username = $user->name;
        $search = $request->input('search_user');

        // Search in the title and body columns from the posts table
        $social_data = User::where('name', $search)->get();
    
        // Return the search view with the resluts compacted
        return view('social')->with(compact('social_data'))->with(compact('username'));
    }

    public function following() {
        $user = Auth::user(); // get currently logged in user
        $username = $user->name;
        $user_id = $user->id;

        $followings = $user->followings()->get();
        return view('followings')->with(compact('followings'))->with(compact('username'));
    }

    public function followers() {
        $user = Auth::user(); // get currently logged in user
        $username = $user->name;
        $user_id = $user->id;

        $followers = $user->followers()->get();
        return view('followers')->with(compact('followers'))->with(compact('username'));
    }

    public function follow(Request $request) {
        $user = Auth::user(); // get currently logged in user
        $username = $user->name;
        // $user_id = $user->id;
        $following_id = $request->user_id;

        $user->followings()->attach($following_id);
        return redirect()->route('following');
    }

    public function unfollow(Request $request) {
        $user = Auth::user(); // get currently logged in user
        $username = $user->name;
        $user_id = $user->id;
        $following_id = $request->user_id;

        $user->followings()->detach($following_id);
        return redirect()->route('following');
    }

    public function removeFollower(Request $request) {
        $user = Auth::user(); // get currently logged in user
        $username = $user->name;
        $user_id = $user->id;
        $follower_id = $request->user_id;

        $user->followers()->detach($follower_id);
        return redirect()->route('followers');
    }
}