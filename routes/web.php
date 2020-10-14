<?php

use App\Models\User;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImpersonatorController;
use App\Http\Controllers\MembersImportController;
use App\Http\Controllers\UpdateManagerController;
use App\Http\Controllers\ViewInspectorController;

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

Route::get('/view-inspector',[ViewInspectorController::class,'index']);

/**
 * Only un-authenticated users - note authenticated users will 
 * be redirected by middleware to their corrent dashboard
 * if they try to access this route
 */
Route::middleware(['guest:contact,web'])->get('/', function() {
    return view('welcome');
})->name('welcome');


// Route::middleware(['guest:contact,web'])->get('/register', function() {
//     return view('gc.organisation.register');
// })->name('register');



/**
 * route:/register/account
 * route name: register.setup.account
 * auth: guest
 * controller and method: -
 * view:organisation.setup-account
 * view layout: 
 * view components: livewire: create-account
 */
// Route::middleware(['guest:contact,web'])->get('/register/account', function() {
//     return view('organisation.setup-account');
// })->name('register.setup.account');





/**
 * Route group for all authenticated and verified accounts,
 * including sysadmin, organisation managers and individual
 * contacts - basically anyone who is authenticated!
 */
Route::middleware(['auth:contact,web','verified'])->group( function(){

//     /**
//      * These routes support  user impersonation for the sys admin
//      */
//     Route::post('/impersonate',[ImpersonatorController::class,'impersonate'])->name('impersonate.start');
//     Route::get('/impersonate-stop', [ImpersonatorController::class, 'stopImpersonate'])->name('impersonate.stop');

//     /**
//      * Dashboard controller is used by all authenticated users and it determines 
//      * the correct dashboard to display for the user.
//      */
    Route::middleware(['auth:contact,web','verified'])->get('/dashboard', [DashboardController::class,'index'])->name('dashboard');


});

/**
 * Route group for authenticated and verified accounts,
 * including sysadmin, organisation managers but NOT individual contacts
 * as they are authenticated via the contact guard
 */
// Route::middleware(['auth:web','verified'])->group( function(){

//     /**
//      * Managers and sysadmin use these routes to update user details
//      */
//     Route::get('user/{user}/edit',[UpdateManagerController::class, 'edit'])->name('user.edit');
//     Route::put('user/{user}/name',[UpdateManagerController::class, 'updateName'])->name('user.update.name');
//     Route::put('user/{user}/email',[UpdateManagerController::class, 'updateEmail'])->name('user.update.email');
//     Route::put('user/{user}/password',[UpdateManagerController::class, 'updatePassword'])->name('user.update.password');

//     /**
//      * Routes for updating organisation details
//      * 
//      * This is a dummy one for now
//      */
//     Route::get('organisation/{organisation}/edit', function(Organisation $organisation){
//         dd($organisation);
//        })->name('organisation.edit');


// });


// /**
//  * Experimental code for uploading excel files with member data
//  */
// Route::get('uploadfile',[MembersImportController::class, 'index']);
// Route::post('uploadfile',[MembersImportController::class, 'import']);










// Route::get('contactlogin', function() {

//     $user = App\Models\Contact::first();
//     Auth::guard('contact')->login($user);


//     return redirect('/');
// });

// Route::get('/contact/home',function(){
//    dd('contact home page ');
// });

// Route::get('contacthome', function(){
//     //Auth::guard('contact')->logout();
    

//    Auth::guard('contact')->user()->leaveImpersonation();
// //    dd(Auth::guard('contact')->User());
// //    dd(Auth::User());
//    return redirect('/');
// });





Route::get('user/changepassword',function() {
    return view('profile.show');
});

// Route::get('library', function() {
//     return view('library');

// });

