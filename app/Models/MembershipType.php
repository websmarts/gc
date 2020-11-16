<?php

namespace App\Models;

use Illuminate\Support\Carbon;
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
        'renewal_month',

    ];

    protected $dates = ['deleted_at'];

    public function current_subscription_start_date()
    {
        $now = Carbon::now();
        $nowMonth = $now->month;
        $nowYear = $now->year;

        if($nowMonth >= $this->renewal_month){
            // Start was last year
            return new Carbon('01-'.$this->renewal_month.'-'.--$nowYear);
        }
        return new Carbon('01-'.$this->renewal_month.'-'.$nowYear);
    }

    /**
     * Accessor so we can use dollars (not cents) for display and editing
     */
    public function getMembershipFeeAsDollarsAttribute()
    {
        return $this->membership_fee !== 0 ? $this->membership_fee / 100 : 0;
    }
    /**
     * Mutator to convert dollar value to cents
     */
    public function setMembershipFeeAsDollarsAttribute($value)
    {
        $this->membership_fee = $value * 100;
    }


    public function memberships()
    {
        return $this->hasMany('App\Models\Membership');
    }

    public function organisation()
    {
        return $this->belongsTo('App\Models\Organisation');
    }
}
