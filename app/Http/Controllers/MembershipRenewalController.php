<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembershipRenewalController extends Controller
{
    public function index()
    {

        return view('manager.membership.due-for-renewal-list');

    }
}
