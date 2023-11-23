<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CardController;
use App\Http\Controllers\ItemController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\EventsController;

use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Start
Route::redirect('/', '/login');

// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLog')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showReg')->name('register');
    Route::post('/register', 'register');
});

// Home
Route::controller(HomeController::class)->group(function () { 
    Route::get('/home','showHome');
});

//User
Route::controller(UserController::class)->group(function () {
    Route::get('/user/{id}', 'showUser')->where('id','[0-9]+')->name('profile');
});

// Events
Route::controller(EventsController::class)->group(function () {

    Route::get('/events-begin', [EventsController::class, 'showEvents'])->name('events.begin');
    Route::get('/event/{id}', 'show')->where('id', '[0-9]+')->name('event.show');

    Route::get('/event/edit', 'editEvent');
    Route::post('/events/create', [EventsController::class, 'createEvent'])->name('events.createEvent');
    Route::get('/events/create', [EventsController::class, 'showCreateForm'])->name('events.create');
    Route::post('/event/delete', 'deleteEvent');
    Route::post('/event/addtowishlist', 'addToWishlist');
    Route::post('/event/removefromwishlist', 'removeFromWishlist');
    Route::get('/events/search', [EventsController::class, 'search'])->name('events.search');

});


// API
Route::controller(CardController::class)->group(function () {
    Route::put('/api/cards', 'create');
    Route::delete('/api/cards/{card_id}', 'delete');
});

Route::controller(ItemController::class)->group(function () {
    Route::put('/api/cards/{card_id}', 'create');
    Route::post('/api/item/{id}', 'update');
    Route::delete('/api/item/{id}', 'delete');
});


// profile page

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit-photo', [ProfileController::class, 'editProfilePhotoForm'])->name('profile.editPhotoForm');
    Route::post('/profile/update-photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile.updatePhoto');
});