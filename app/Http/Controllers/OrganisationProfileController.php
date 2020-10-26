<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;

class OrganisationProfileController extends Controller
{
    public function edit(Organisation $organisation)
    {
        return view('manager.organisation-profile-edit')->with('organisation',$organisation);
    }
}
