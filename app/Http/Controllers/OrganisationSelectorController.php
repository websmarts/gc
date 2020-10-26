<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;

class OrganisationSelectorController extends Controller
{

    public function index(Request $request)
    {
        // Check if user is an Organisation Manager
        if (!auth()->user()->checkRole('account-manager')) {
            abort(404);
        }


        $organisations = auth()->user()->organisations;
        $selectedOrganisation = false;



        if ($request->session()->has('selected_organisation_uuid')) {
            $uuid = $request->session()->get('selected_organisation_uuid');
            $selectedOrganisation = Organisation::with(['contacts', 'memberships'])->where('uuid', $uuid)->first();
        } else if ($organisations->count() == 1) {
            $selectedOrganisation = $organisations->first();
            $request->session->setput('selected_organisation_uuid', $selectedOrganisation->uuid);
        }

        return view('manager.organisations', compact('organisations', 'selectedOrganisation'));
    }
}
