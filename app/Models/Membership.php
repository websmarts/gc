<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Events\MembershipWasDeleted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    use  SoftDeletes;

    const STATUSES = [

        'pending' => 'Pending approval',
        'active' => 'Active',
        'paused' => 'Paused',
    ];

    protected $fillable = [
        'name',
        'membership_type_id',
        'start_date',
        'last_renewal_sent_date',
        'last_paid_date',
        'last_paid_amount',
        'status'
    ];


    protected $dispatchesEvents = [
        'deleted' => MembershipWasDeleted::class,
    ];

    protected $dates = ['start_date', 'last_renewal_sent_date' , 'last_paid_date', 'deleted_at'];

    
    public function getFeeDueAmountForDisplayAttribute()
    {
        return $this->fee_due_amount != 0 ? number_format($this->fee_due_amount / 100, 2) : 0;
    }

    /**
     * Relationships
     */
    public function membershipType()
    {
        return $this->belongsTo('App\Models\MembershipType');
    }

    // public function primaryContact()
    // {
    //     $members = $this->members->
    // }

    public function members()
    {
        return $this->belongsToMany('App\Models\Contact', 'contacts_memberships', 'membership_id', 'contact_id')
            ->withPivot('is_primary_contact');
    }
}
