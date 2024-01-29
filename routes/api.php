<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\Frontend\HotelsController;
use App\Http\Controllers\Frontend\CustomerAuthController;
use App\Http\Controllers\Frontend\CustomerProfileController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\BookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 
 Route::post('/events', [CalendarController::class, 'store']);
 Route::get('/availability/{room_id}', [CalendarController::class, 'getAvailability'])->name('api.availability');
 Route::post('/delete-event', [CalendarController::class, 'destroyEvent'])->name('api.events.destroy'); 

 Route::post('/rooms/{id}/closetoday', [RoomController::class, 'closeRoomToday']);
 Route::post('/rooms/{id}/opentoday', [RoomController::class, 'openRoomToday']);
Route::get('/rooms/{hotelId}/checkavailabilityToday', [RoomController::class, 'getRoomsForToday']);

 Route::post('/get-room-price', [CalendarController::class, 'checkRoomPrice'])->name('checkRoomPrice');
 Route::post('/add-room-price', [CalendarController::class, 'addRoomPrice']);

 Route::post('/remove-user/{userId}', [UserController::class,'removeUser'])->name('remove.user');
 Route::get('/accept-invite/{userId}', [UserController::class,'acceptInvite'])->name('accept-invite');




 //reacta gidişler

Route::get('/hotel/all', [HotelsController::class, 'hotellistele']);
Route::get('/hotel/{id}', [HotelsController::class, 'showhotel']);
Route::get('/hotel/rooms/{id}', [HotelsController::class, 'getRoomsForHotel']); 

Route::get('/hotels-by-room-amenitie/{roomAmenitieId}', [HotelsController::class, 'getHotelsByRoomAmenitie']);
Route::get('/hotels-by-hotel-amenitie/{hotelAmenitieId}', [HotelsController::class, 'getHotelsByHotelAmenitie']);

Route::post('/hotel/search', [HotelsController::class, 'api_hotels_search']);
Route::post('/filter', [HotelsController::class, 'filtreleme']);

Route::get('/hotels/reviews/{id}',[CommentController::class, 'getReviews']);

Route::post('/login', [CustomerAuthController::class, 'login_submit']);
Route::post('/register', [CustomerAuthController::class, 'signup_submit']);
Route::get('/signup-verify/{email}/{token}', [CustomerAuthController::class, 'signup_verify']);

Route::middleware(['auth:customer'])->group(function () {
    Route::get('/customer/orders', [CustomerProfileController::class, 'getCustomerOrders']);
    Route::post('/customer/change-password/{customerId}', [CustomerProfileController::class, 'changePassword']);
    Route::post('/customer/update-profile', [CustomerProfileController::class, 'updateProfile']);
    Route::post('/comments/store', [CommentController::class, 'store']);

    Route::get('/customers/reviews/{customerId}', [CommentController::class, 'getUserReviews']);

    Route::post('/reservation-create', [BookingController::class, 'create']);
});

