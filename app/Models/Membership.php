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

    // Accessors
    public function getLatestRenewalIssuedDateProperty()
    {
       if($renewal = $this->latestRenewalNoticeQuery()->first()) return $renewal->issued_date;
    }
    public function getLatestRenewalRenewalPaymentDateProperty()
    {
       if($renewal = $this->latestRenewalPaymentQuery()->first()) return $renewal->when_received;
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
        return $this->hasMany('App\Models\Transaction', 'membership_id', 'id')
            ->where(['regarding' => 'membership renewal', 'type' => 'invoice']);
    }

    /**
     * Helpers
     */
    public function primaryContact()
    {
        return $this->members->where('pivot.is_primary_contact', true)->first();
    }

    /**
     * returns hasMany queryBuilder
     */
    public function latestRenewalPaymentQuery()
    {
        return $this->renewalTransactions()->latest('when_received');
    }


    /**
     * Returns hasMany queryBuilder
     */
    public function latestRenewalNoticeQuery()
    {
        // return the date of the latest renewal transaction
        return $this->renewals()->latest('issued_date');
    }

    

    public function hasBeenSentRenewal()
    {
        if(! $this->latestRenewalNoticeQuery->first() ) return false;
        
        return $this->latestRenewalNoticeQuery->first()->issued_date->greaterThan($this->membershipType->renewalPaymentStartDate());
    }

    public function isCurrentlyFinancial()
    {
        if (!$this->latestRenewalPaymentQuery->first()) {
            return false;
        }

        // Transaction record exists but no when_received value has been set
        if(!$this->latestRenewalPaymentQuery->first()->when_received){
            return false;
        }

        return  $this->latestRenewalPaymentQuery->first()->when_received
            ->greaterThan($this->membershipType->renewalPaymentStartDate());
    }

    /**
     * returns true if membership is renewable
     */
    public function isRenewable()
    {
       return  $this->status === 'active' 
       && $this->primaryContact()
       && $this->primaryContact()->verifiedEmailAddress()
       && ! $this->isCurrentlyFinancial() 
       && ! $this->hasBeenSentRenewal();
    }
    public function isNotRenewable()
    {
        return ! $this->isRenewable();
    }
}
