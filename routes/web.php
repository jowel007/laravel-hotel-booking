<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\RoomController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[UserController::class,'Index']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/password/change/password', [UserController::class, 'ChangePasswordStore'])->name('password.store');
});

require __DIR__.'/auth.php';

// admin group middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

// admin group middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {

    // team all route
   Route::controller(TeamController::class)->group(function(){
        Route::get('/all/team', 'AllTeam')->name('all.team');
        Route::get('/add/team', 'AddTeam')->name('add.team');
        Route::post('/store/team', 'StoreTeam')->name('store.team');
        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
        Route::post('/update/team', 'UpdateTeam')->name('update.team');
        Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team');
   });

    // Book area all route
    Route::controller(TeamController::class)->group(function(){
        Route::get('/book/area', 'BookArea')->name('book.area');
        Route::post('/update/book/area', 'UpdateBookArea')->name('update.book.area');
   });

   // Room type all route
   Route::controller(RoomTypeController::class)->group(function(){
    Route::get('/room/type/list', 'RoomTypeList')->name('room.type.list');
    Route::get('/add/room/type', 'AddRoomType')->name('add.room.type');
    Route::post('/store/room/type', 'StoreRoomType')->name('store.room.type');
   });

    // Room all route
    Route::controller(RoomController::class)->group(function(){
        Route::get('/edit/room/{id}', 'EditRoom')->name('edit.room');
        Route::post('/update/room/{id}', 'UpdateRoom')->name('update.room');

    });


});
