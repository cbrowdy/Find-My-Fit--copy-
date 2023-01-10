<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class WeatherController extends Controller
{
    public function get_weather() {
        $description =  Request::get('description');
        $temp =  Request::get('temp');
        $location =  Request::get('location');
        dd($description);
    }

    public function store_weather(Request $request) {
    
        $request->validate([
            'description'  => 'required',
            'temp' => 'required',
            'location' => 'required',
        ]);


     $user = Auth::user(); // get currently logged in user
     $user_id = $user->id; // get the user's id
     $weather = array(
      'description'  => $request->description,
      'temp' => $request->temp,
      'location' => $request->location,
      'user_id' => $user_id
     );

     Weather::create($weather);

     return redirect()->back()->with('success', 'Weather stored in database successfully');
    }
}
