<?php

use App\Models\User;
use App\Models\Membership;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Jobs\SendMembershipRenewalEmail;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImpersonatorController;
use App\Http\Controllers\MembersImportController;
use App\Http\Controllers\UpdateManagerController;
use App\Http\Controllers\ViewInspectorController;
use App\Http\Controllers\OrganisationSetController;
use App\Http\Controllers\MembershipRenewalController;
use App\Http\Controllers\OrganisationProfileController;
use App\Http\Controllers\OrganisationSelectorController;

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

Route::get('/view-inspector', [ViewInspectorController::class, 'index']);

Route::get('privacy',function(){
    return view('privacy');
});

/**
 * EXPERIMENTAL Members moving to groupcare register here
 */
Route::get('member/registration/for/{slug}',function($slug){
    $organisation = Organisation::where('slug',$slug)->firstOrFail();
    return view('member.registration',['uuid' => $organisation->uuid]);
});

/**
 * Only un-authenticated users - note authenticated users will 
 * be redirected by middleware to their corrent dashboard
 * if they try to access this route
 */
Route::middleware(['guest:contact,web'])->get('/', function () {
    return view('welcome');
    // return redirect('/login');
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


// TODO add a get logout url
Route::get('logout',function(){
    auth()->logout();
    return redirect('/');
});

Route::get('renew/{membershipIdHash?}', [MembershipRenewalController::class,'index'])->name('membership-renewal');

Route::get('confirm-renewal-payment',function(){
    return view('membership.confirm-renewal-payment');
})->name('confirm-renewal-payment');

Route::get('cancel-membership/{membershipIdHash}',function($membershipIdHash){

   
    if($membership = Membership::find(app()->hasher->decode($membershipIdHash)[0])){
        $membership->delete();
    }
    // Set membership status to pending-deleteion confirmation
    

    // Fire membership canceled event - emails primary contact a confirmation email

    return view('membership.cancel-confirm');

})->name('cancel-membership');

//Paypaldev stuff
Route::post('membership-renewal-payment/{membership}',[PayPalController::class, 'membershipRenewalPayment'])->name('setup-paypal-membership-renewal-payment');
Route::post('capture-paypal-transaction',[PayPalController::class, 'capture'])->name('capture-paypal-membership-renewal-payment');
//Route::get('get-paypal-transaction',[PayPalController::class, 'get'])->name('get-paypal-transaction');
Route::get('paypal-return',[PayPalController::class, 'paypalReturn'])->name('paypal-return');
Route::match(['get','post'],'paypal-cancel',[PayPalController::class, 'paypalCancel'])->name('paypal-cancel'); // handles xhr cancel request


Route::get('membership-renewal-confirmed/{membershipIdHash}',[MembershipRenewalController::class,'confirm'])->name('membership-renewal-confirm');
Route::get('renew-offline/{membershipIdHash}',[MembershipRenewalController::class,'offline'])->name('membership-renew-offline'); 
/**
 * Single Sign On or Contact guarded route group
 * TODO add middleware and routes
 */
// Handle contact request to cancel membership

// Handle contact request to update profile/preferences


/**
 * Route group for all authenticated and verified accounts,
 * including sysadmin, organisation managers and individual
 * contacts - basically anyone who is authenticated!
 */
Route::middleware(['auth:contact,web', 'verified'])->group(function () {

    //     /**
    //      * These routes support  user impersonation for the sys admin
    //      */
    //     Route::post('/impersonate',[ImpersonatorController::class,'impersonate'])->name('impersonate.start');
    //     Route::get('/impersonate-stop', [ImpersonatorController::class, 'stopImpersonate'])->name('impersonate.stop');

    //     /**
    //      * Dashboard controller is used by all authenticated users and it determines 
    //      * the correct dashboard to display for the user.
    //      */

    

    Route::middleware(['auth', 'verified'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Register an Organisation
        Route::get('register-organisation', function () {
            return view('manager.organisation-register');
        })->name('organisation.register');

        // Manage MembershipTypes for the selected Organisation
        Route::get('membershiptypes', function () {
            return view('manager.membershiptypes');
        })->name('membershiptypes');

        // Members Register for the selected Organisation
        Route::get('members-register', function () {
            return view('manager.members-register');
        })->name('members.register');

        // Create a Membership for the selected Organisation
        Route::get('create-membership', function () {
            return view('manager.create-membership');
        })->name('create.membership');

        // Manage a Memberships members
        Route::get('membership/{membership}/members', function ($membership) {
            return view('manager.membership-members')->with('membership', $membership);
        })->name('membership.members');

        
        // Manage the contacts register for the selected Organisation
        Route::get('contacts-register', function () {
            return view('manager.contacts-register');
        })->name('contacts.register');

        // Manage the positions register for the selected Organisation
        Route::get('positions-register', function () {
            return view('manager.positions-register');
        })->name('positions.register');

        // Manage the settings for the selected Organisation
        Route::get('organisation-settings', function () {
            return view('manager.organisation-settings');
        })->name('organisation.settings');



        // Edit organisation propile
        Route::get('/organisation/{organisation}/edit', [OrganisationProfileController::class, 'edit'])->name('organisation.profile.edit');


        /**
         * Experimental code for uploading excel files with member data
         */
        Route::get('uploadfile', [MembersImportController::class, 'index']);
        Route::post('uploadfile', [MembersImportController::class, 'import']);

        /**
         * Experimental code for processing organisation membership renewal notices
         */
        Route::get('renewals',function() {
            $m = selectedOrganisation()->memberships->first();
            $primaryContact = $m->members->where('pivot.is_primary_contact',true)->first();

            $details = [
                'email'=> $primaryContact->email,
                'membership_id_hash' => app('hasher')->encode([$m->id, time(),24]),
                'organisation_name'=>"Neerim and District Landcare Group",
                'primary_contact' => $primaryContact->name,
                'membership_name'=>$m->name,
                'subscription_period_end_date' =>  $m->membershipType->currentSubscriptionPeriod()->end_date->format('d-m-Y'),
                'subscription_period_start_date' =>  $m->membershipType->currentSubscriptionPeriod()->start_date->format('d-m-Y'),
                ];


            return new App\Mail\MembershipRenewal($details);

           //dispatch(new SendMembershipRenewalEmail($details));

        });

       
    });
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





Route::get('user/changepassword', function () {
    return view('profile.show');
});

// Route::get('library', function() {
//     return view('library');

// });
