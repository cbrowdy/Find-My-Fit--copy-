<?php

namespace App\Http\Controllers;
use App\Models\Images;
use Illuminate\Support\Facades\Response;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WardrobeController extends Controller
{
    function index()
    {
      $user = Auth::user(); // get currently logged in user
      $user_id = $user->id; // get the user's id
      $username = $user->name;

     $data = Images::where('user_id', $user_id)->latest()->paginate(50);
     return view('home', compact('data'))
       ->with('i', (request()->input('page', 1) - 1) * 5)->with(compact('username'));
    }

    function index_inner(){
      $user = Auth::user(); // get currently logged in user
      $user_id = $user->id; // get the user's id
      $username = $user->name; // get the user's id


     $data = Images::where('user_id', $user_id)-> where('type', '=', "Innerwear")->latest()->paginate(5);
     return view('home', compact('data'))
       ->with('i', (request()->input('page', 1) - 1) * 5)->with(compact('username'));
    }

    function index_outter(){
      $user = Auth::user(); // get currently logged in user
      $user_id = $user->id; // get the user's id
      $username = $user->name; // get the user's id


     $data = Images::where('user_id', $user_id)-> where('type', '=', "Outterwear")->latest()->paginate(5);
     return view('home', compact('data'))
       ->with('i', (request()->input('page', 1) - 1) * 5)->with(compact('username'));
    }

    function index_bottom(){
      $user = Auth::user(); // get currently logged in user
      $user_id = $user->id; // get the user's id
      $username = $user->name; // get the user's id

     $data = Images::where('user_id', $user_id)-> where('type', '=', "Bottom")->latest()->paginate(5);
     return view('home', compact('data'))
       ->with('i', (request()->input('page', 1) - 1) * 5)->with(compact('username'));
    }
    function index_shoes(){
      $user = Auth::user(); // get currently logged in user
      $user_id = $user->id; // get the user's id
      $username = $user->name; // get the user's id

     $data = Images::where('user_id', $user_id)-> where('type', '=', "Shoes")->latest()->paginate(5);
     return view('home', compact('data'))
       ->with('i', (request()->input('page', 1) - 1) * 5)->with(compact('username'));
    }

    public function delete_image($image_id){
      Images::where('id', $image_id)->delete();
      return redirect()->back()->with('success', 'Image deleted');
    }

    function insert_image(Request $request)
    {
     $request->validate([
      'user_name'  => 'required',
      'user_image' => 'required|image|max:65536'
     ]);

     $image_file = $request->user_image;

     $image = Image::make($image_file);

     Response::make($image->encode('jpeg'));

     $form_data = array(
      'user_name'  => $request->user_name,
      'user_image' => $image
     );

     Images::create($form_data);

     return redirect()->back()->with('success', 'Image store in database successfully');
    }

    function fetch_image($image_id)
    {
      $user = Auth::user(); // get currently logged in user
      $user_id = $user->id; // get the user's id
      $image = Images::where('user_id', $user_id)->findOrFail($image_id);


     $image_file = Image::make($image->user_image);

     $response = Response::make($image_file->encode('jpeg'));

     $response->header('Content-Type', 'image/jpeg');

     return $response;
    }
}
