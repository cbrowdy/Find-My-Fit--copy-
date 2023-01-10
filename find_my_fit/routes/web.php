<?php
use App\Http\Controllers\StoreImageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/fitme', function () {
    $user = Auth::user(); // get currently logged in user
    $username = $user->name;
    return view('dashboard')->with(compact('username'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', 'App\Http\Controllers\WardrobeController@index')->middleware(['auth', 'verified'])->name('wardrobe');

require __DIR__.'/auth.php';

Route::get('store_image', [StoreImageController::class, 'index'])->middleware(['auth', 'verified']);

Route::post('store_image/insert_image', [StoreImageController::class, 'insert_image'])->middleware(['auth', 'verified']);

Route::get('wardrobe/store_image/fetch_image/{id}', [StoreImageController::class, 'fetch_image'])->middleware(['auth', 'verified']);

Route::get('/wardrobe/all', 'App\Http\Controllers\WardrobeController@index')->middleware(['auth', 'verified'])->name('wardrobe-all');

Route::get('/account', 'App\Http\Controllers\AccountController@index')->middleware(['auth', 'verified'])->name('account');
Route::get('/wardrobe/wardrobe/delete_image/{id}', 'App\Http\Controllers\WardrobeController@delete_image')->middleware(['auth', 'verified']);
Route::get('/account_social', 'App\Http\Controllers\AccountController@index')->middleware(['auth', 'verified'])->name('account_social');

Route::get('/account/delete_outfit/{id}', 'App\Http\Controllers\AccountController@delete_outfit')->middleware(['auth', 'verified']);
Route::get('/fetch_inner/{innerwear}', 'App\Http\Controllers\AccountController@fetch_inner')->middleware(['auth', 'verified']);
Route::get('/fetch_outter/{outterwear}', 'App\Http\Controllers\AccountController@fetch_outter')->middleware(['auth', 'verified']);
Route::get('/fetch_bottom/{bottom}', 'App\Http\Controllers\AccountController@fetch_bottom')->middleware(['auth', 'verified']);
Route::get('/fetch_shoes/{shoes}', 'App\Http\Controllers\AccountController@fetch_shoes')->middleware(['auth', 'verified']);

Route::get('/fetch_inner/{innerwear}/{user_id}', 'App\Http\Controllers\AccountController@social_fetch_inner')->middleware(['auth', 'verified']);
Route::get('/fetch_outter/{outterwear}/{user_id}', 'App\Http\Controllers\AccountController@social_fetch_outter')->middleware(['auth', 'verified']);
Route::get('/fetch_bottom/{bottom}/{user_id}', 'App\Http\Controllers\AccountController@social_fetch_bottom')->middleware(['auth', 'verified']);
Route::get('/fetch_shoes/{shoes}/{user_id}', 'App\Http\Controllers\AccountController@social_fetch_shoes')->middleware(['auth', 'verified']);

Route::get('/wardrobe/inner', 'App\Http\Controllers\WardrobeController@index_inner')->middleware(['auth', 'verified']);
Route::get('/wardrobe/outter', 'App\Http\Controllers\WardrobeController@index_outter')->middleware(['auth', 'verified']);
Route::get('/wardrobe/bottom', 'App\Http\Controllers\WardrobeController@index_bottom')->middleware(['auth', 'verified']);
Route::get('/wardrobe/shoes', 'App\Http\Controllers\WardrobeController@index_shoes')->middleware(['auth', 'verified']);


Route::get('/outfit_generation', function () {
    return view('outfit_generation');
})->middleware(['auth', 'verified'])->name('outfit_generation_page');

Route::post('/generated_outfit/insert_outfit', [App\Http\Controllers\OutfitGenerationController::class, 'insert_outfit'])->middleware(['auth', 'verified'])->name('store-outfit');
Route::post('/generated_outfit', [App\Http\Controllers\OutfitGenerationController::class, 'basic_outfit'])->middleware(['auth', 'verified'])->name('generate_outfit');

Route::get('/social_page', [App\Http\Controllers\AccountController::class, 'get_social_page'])->middleware(['auth', 'verified'])->name('get_social_page');
Route::post('/store_user_id', 'App\Http\Controllers\AccountController@get_other_account')->middleware(['auth', 'verified'])->name('get_other_account');
Route::get('/search_user', 'App\Http\Controllers\AccountController@search_user')->middleware(['auth', 'verified'])->name('search_user');
Route::get('/following', 'App\Http\Controllers\AccountController@following')->middleware(['auth', 'verified'])->name('following');
Route::get('/followers', 'App\Http\Controllers\AccountController@followers')->middleware(['auth', 'verified'])->name('followers');
Route::post('/follow', 'App\Http\Controllers\AccountController@follow')->middleware(['auth', 'verified'])->name('follow');
Route::post('/unfollow', 'App\Http\Controllers\AccountController@unfollow')->middleware(['auth', 'verified'])->name('unfollow');
Route::post('/removeFollower', 'App\Http\Controllers\AccountController@removeFollower')->middleware(['auth', 'verified'])->name('removeFollower');





Route::get('/get_weather', 'App\Http\Controllers\WeatherController@get_weather')->middleware(['auth', 'verified'])->name('get_weather');
Route::post('/store_weather', 'App\Http\Controllers\WeatherController@store_weather')->middleware(['auth', 'verified'])->name('store_weather');



require __DIR__.'/auth.php';

