<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        // Check for system admin user
        if (auth()->user()->hasRole('system-administrator')) {
            return view('admin.dashboard');
        }


        // Check if user is a contact an can only manage their own contact details 
        // if( auth('contact')->check() ){ //single contact manager
        //     return view('contact.dashboard');
        // }


        // Check if user is an Organisation Manager
        abort_if(!auth()->user()->checkRole('account-manager'), 403);

        $organisations = auth()->user()->organisations;


        if ($uuid = auth()->user()->last_selected_organisation_uuid) {
            $organisation = Organisation::where('uuid', $uuid)->first();
            return view('manager.dashboard', compact('organisation','organisations'));
        }

        // if ($uuid = selected_organisation()) {
        //     $organisation = Organisation::where('uuid', $uuid)->first();
        //     return view('manager.dashboard', compact('organisation','organisations'));
        // }

        if ($organisations->count() > 0) {
            $organisation = $organisations->first();
            selected_organisation($organisation->uuid);
            return view('manager.dashboard', compact('organisation','organisations'));
        }

        return view('manager.organisation-register');
    }
}
