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

    protected $appends = [
        'membership_fee_as_dollars'
    ];

    /**
     * Accessor so we can use dollars (not cents) for display and editing
     */
    public function getMembershipFeeAsDollarsAttribute()
    {
        return $this->membership_fee !== 0 ? number_format($this->membership_fee / 100 ,2): 0;
    }
    /**
     * Mutator to convert dollar value to cents
     */
    public function setMembershipFeeAsDollarsAttribute($value)
    {
        $this->membership_fee = $value * 100;
    }

    /**
     * The start date of the current subscription year
     */
    private function current_subscription_start_date()
    {
        $now = Carbon::now();
        $nowMonth = $now->month;
        $nowYear = $now->year;

        if($nowMonth >= $this->renewal_month){
            // Start was last year
            return new Carbon('01-'.$this->renewal_month.'-'.$nowYear);
        }
        return new Carbon('01-'.$this->renewal_month.'-'.--$nowYear);
    }

    /**
     * Returns the subscription year start and end dates
     */
    public function currentSubscriptionPeriod()
    {
        return (object) [
            'start_date'=> $this->current_subscription_start_date(),
            'end_date' => $this->current_subscription_start_date()->addYear(),
        ];
    }

    /**
     * Days since the start of the subscription year
     */
    public function daysIntoSubscription()
    {
        return $this->currentSubscriptionPeriod()->start_date->diffInDays();
    }

    

    /**
     * Any payments received after this date are considered payment for the full year
     * eg if grace period is 90 days and renewal month is 7 then any payments made during or
     * after the 90 day period will be considered payment for the full year
     */
    public function renewalPaymentStartDate()
    {
        return $this->currentSubscriptionPeriod()->start_date->addDays(-$this->grace_period_days);
    }


    // Relationships
    public function memberships()
    {
        return $this->hasMany('App\Models\Membership');
    }

    public function organisation()
    {
        return $this->belongsTo('App\Models\Organisation');
    }
}
