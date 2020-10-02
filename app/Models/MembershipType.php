<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembershipType extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'organisation_id',
        'name',
        'description',
        'subscription_months',
        'max_people',
        'prorate_signup_fee',
        'grace_period_days',
        'membership_fee',
        'renewal_month'
       
    ];

    protected $dates = ['deleted_at'];

    public function memberships()
    {
        return $this->hasMany('App\Models\Membership');
    }
}
