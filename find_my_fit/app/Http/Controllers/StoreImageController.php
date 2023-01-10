<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;
use Illuminate\Support\Facades\Response;
use Image;
use Illuminate\Support\Facades\Auth;

class StoreImageController extends Controller
{
    function index()
    {
      $user = Auth::user(); // get currently logged in user
      $user_id = $user->id; // get the user's id
      $username = $user->name;
     $data = Images::where('user_id', $user_id)->latest()->paginate(5);
     return view('store_image', compact('data'))
       ->with('i', (request()->input('page', 1) - 1) * 5)->with(compact('username'));
    }

    function insert_image(Request $request)
    {
     $request->validate([
      'user_name'  => 'required',
      'user_image' => 'required|image|max:65536',
      'type' => 'required',
      
     ]);

     $image_file = $request->user_image;

     $image = Image::make($image_file);

     
     Response::make($image->encode('jpeg'));
     //$image_resize = Response::make($image->encode('jpeg'));
     
     $user = Auth::user(); // get currently logged in user
     $user_id = $user->id; // get the user's id
     if(!Images::exists()){
      $form_data = array(
        'user_name'  => NULL,
        'user_image' => NULL,
        'type' => NULL,
        'color'=> NULL,
        'user_id' => 0
       );
       Images::create($form_data);
     }

     $form_data = array(
      'user_name'  => $request->user_name,
      'user_image' => $image,
      'type' => $request->type,
      'color'=> $request->color,
      'user_id' => $user_id
     );
     Images::create($form_data);

     return redirect()->back()->with('success', 'Wardrobe Item Added!');
    }

    function fetch_image($image_id)
    {
          //  Shipment::where('display_id', $display_id)->firstOrFail();
     $user = Auth::user(); // get currently logged in user
     $user_id = $user->id; // get the user's id
   
     $image = Images::where('user_id', $user_id)->findOrFail($image_id);

     $image_file = Image::make($image->user_image);

     $response = Response::make($image_file->encode('jpeg'));
    //  return view('dashboard.billing.edit_payment_method', compact('card', 'user'));

     $response->header('Content-Type', 'image/jpeg');
    

     return $response;
    }
}