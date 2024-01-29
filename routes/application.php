<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\SocialAppController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\FilemanagerController;
use App\Http\Controllers\JobController;

/************************ Application Routes Start ******************************/
Route::group(['middleware'=>'auth'],function(){
    

    
    Route::group(['prefix'=>'{language}'],function(){
        Route::group(['prefix'=>'applications'],function(){
            
    
            Route::group(['prefix'=>'job','as'=>'job.'],function(){
                Route::get('job-search',[JobController::class,'index'])->name('job_search');
                Route::get('job-search-list',[JobController::class,'list'])->name('job_search_list');
                Route::get('job-detail',[JobController::class,'detail'])->name('job_detail');
                Route::get('job-apply',[JobController::class,'apply'])->name('job_apply');
            });
        
            Route::group(['prefix'=>'email','as'=>'email.'],function(){
                Route::get('inbox',[EmailController::class,'index'])->name('inbox');
                Route::get('read',[EmailController::class,'read'])->name('read');
            });
        
            Route::get('chat',[ChatController::class,'index'])->name('chat');
        
            Route::group(['prefix'=>'hotels','as'=>'hotel.'],function(){
                Route::get('room_list',[EcommerceController::class,'index'])->name('products');
                Route::get('room-list',[EcommerceController::class,'productList'])->name('product_list');
                Route::get('product-detail',[EcommerceController::class,'productDetail'])->name('product_detail');
                Route::get('room-add',[EcommerceController::class,'addProduct'])->name('add_product');
                Route::post('room-delete/{room_id}', [RoomController::class, 'deleteRoom'])->name('room_delete');
                Route::get('cart',[EcommerceController::class,'cart'])->name('cart');
                Route::get('orders',[EcommerceController::class,'orders'])->name('orders');
                Route::get('sellers',[EcommerceController::class,'sellers'])->name('sellers');
                Route::get('invoice',[EcommerceController::class,'invoice'])->name('invoice');
                
                  Route::middleware('checkRole')->group(function () {
                Route::get('team',[UserController::class,'grid'])->name('grid');
                  });
            });

             Route::group(['prefix'=>'reservations','as'=>'reservation.'],function(){
                Route::get('reservations',[ReservationController::class,'index'])->name('reservations');
                Route::get('reservation-search',[ReservationController::class,'reservationsearch'])->name('reservationsearch');
                 Route::middleware(['checkReservationOwnership'])->group(function () {
                Route::get('updateStatus/{reservationId}',[ReservationController::class,'updateStatus'])->name('updateStatus');
                });
                Route::middleware(['checkInvoiceOwnership'])->group(function () {
                Route::get('invoice/{reservationId}', [ReservationController::class, 'ReservationInvoice'])->name('invoice');
                });

                });
        
            Route::group(['prefix'=>'social','as'=>'social.'],function(){
                Route::get('profile',[SocialAppController::class,'index'])->name('profile');
                Route::get('profile-settings',[SocialAppController::class,'profileSetting'])->name('profile_settings');
                Route::get('timeline',[SocialAppController::class,'timeline'])->name('timeline');
                Route::get('activity',[SocialAppController::class,'activity'])->name('activity');
            });

            


            Route::post('/send-invite', [UserController::class, 'sendInviteEmail'])->name('send-invite');
            Route::post('/accept-invite/{userId}', [UserController::class, 'acceptInvite'])->name('accept-invite');
            Route::post('/reject-invite/{userId}', [UserController::class, 'rejectInvite'])->name('reject-invite');
            Route::post('remove-user/{userId}', [UserController::class,'removeUser'])->name('remove.user');

            

            Route::post('room-add', [RoomController::class, 'createRoom'])->name('room.createx');
             Route::middleware(['check.room.ownership'])->group(function () {
            Route::get('calendar/{room_id}',[CalendarController::class,'getAvailability'])->name('calendar');
            Route::get('pricecalendar/{room_id}',[CalendarController::class,'getRoomPrices'])->name('pricecalendar');
            Route::get('roomdetails/{room_id}',[RoomController::class,'getRoomDetails'])->name('roomdetails');
            Route::put('roomdetails/{room_id}', [RoomController::class, 'updateRoomDetails'])->name('roomdetails.update');
            

        });
            Route::group(['prefix'=>'user','as'=>'user.'],function(){
                Route::get('member',[UserController::class,'index'])->name('member');
                
                Route::get('list',[UserController::class,'list'])->name('list');
                Route::get('grid-style',[UserController::class,'gridStyle'])->name('grid_style');
                Route::get('group',[UserController::class,'userGroup'])->name('group');
                Route::get('add',[UserController::class,'add'])->name('add');
                Route::get('table',[UserController::class,'table'])->name('table');


            });
        
            Route::group(['prefix'=>'contact','as'=>'contact.'],function(){
                Route::get('grid',[ContactController::class,'index'])->name('grid');
                Route::get('list',[ContactController::class,'list'])->name('list');
                Route::get('create',[ContactController::class,'create'])->name('create');
            });
        
            Route::get('note',[NoteController::class,'index'])->name('note');
        
           
            Route::get('filemanager',[FilemanagerController::class,'index'])->name('filemanager');
            Route::get('filemanager-list',[FilemanagerController::class,'list'])->name('filemanager_list');
            Route::get('support-ticket',[SupportController::class,'index'])->name('support_ticket');
            Route::get('support-details',[SupportController::class,'detail'])->name('support_detail');
            
        });
    });    
});
/************************ Application Routes Ends ******************************/