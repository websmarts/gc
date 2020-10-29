<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $user; // current auth user

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        
        // Check for system admin user
        if ($this->user->hasRole('system-administrator')) {
            return view('admin.dashboard');
        }


        // Check if user is a contact an can only manage their own contact details 
        // if( auth('contact')->check() ){ //single contact manager
        //     return view('contact.dashboard');
        // }


        // Check if user is an Organisation Manager
        abort_if(!$this->user->checkRole('account-manager'), 403);

        $organisations = $this->user->organisations;


        if ($uuid = $this->user->selectedOrganisation()) {
            $organisation = Organisation::where('uuid', $uuid)->first();
            return view('manager.dashboard', compact('organisation', 'organisations'));
        }

        // if ($uuid = selected_organisation()) {
        //     $organisation = Organisation::where('uuid', $uuid)->first();
        //     return view('manager.dashboard', compact('organisation','organisations'));
        // }

        if ($organisations->count() > 0) {
            $organisation = $organisations->first();
            $this->user->last_selected_organisation_uuid = $organisation->uuid;
            $this->user->save();
            
            return view('manager.dashboard', compact('organisation', 'organisations'));
        }

        return view('manager.organisation-register');
    }
}
