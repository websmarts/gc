<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipEditController extends Controller
{
    public function index($membershipIdHash){

        // display a view with:
        // Confirmation message
        // Current membership details
        // and offer option to update

        $membership = Membership::with('members','members.address')->findOrFail(app()->hasher->decode($membershipIdHash)[0]);

        return view('membership.update', compact('membership'));
    }
}
