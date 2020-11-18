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
        'status'
    ];


    protected $dispatchesEvents = [
        'deleted' => MembershipWasDeleted::class,
    ];

    protected $dates = ['start_date', 'deleted_at'];

    public function getIdHashAttribute()
    {
        return app()->hasher->encode($this->id);
    }

    /**
     * Relationships
     */
    public function membershipType()
    {
        return $this->belongsTo('App\Models\MembershipType');
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\Contact', 'contacts_memberships', 'membership_id', 'contact_id')
            ->withPivot('is_primary_contact');
    }

    public function renewals()
    {
        return $this->hasMany(MembershipRenewal::class);
    }

    public function renewalTransactions()
    {
        return $this->hasMany('App\Models\Transaction','membership_id','id')
        ->where(['regarding'=>'membership renewal','type'=>'income']);
    }

    /**
     * Helpers
     */
    public function primaryContact()
    {
        return $this->members->where('pivot.is_primary_contact',true)->first();
    }

    public function latestRenewalPayment()
    {
       return $this->renewalTransactions()->orderBy('when_received','desc')->first();
    }
    
    public function latestRenewalNotice()
    {
        // return the date of the latest renewal transaction created_at date
        return $this->renewals()->orderBy('issued_date','desc')->first();
    }
}
