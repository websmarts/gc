<?php

namespace App\Models;

use Illuminate\Support\Carbon;
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
        'organisation_id',
        'membership_type_id',
        'start_date',
        'fee_due_date',
        'fee_due_amount',
        'status'
    ];

    protected $dates = ['start_date','fee_due_date','deleted_at'];

    // Start_date accessor for displaying date
    public function getStartDateForDisplayAttribute()
    {
        return $this->start_date ? $this->start_date->format('d/m/Y') : '' ; // TODO format date for display
    }
    // start_date mutator
    public function setStartDateForDisplayAttribute($value)
    {
        $this->start_date = Carbon::createFromFormat('d/m/Y',$value);
    }

    public function getFeeDueDateForDisplayAttribute()
    {
        return $this->fee_due_date ? $this->fee_due_date->format('d/m/Y') : '' ; // TODO format date for display
    }

    public function getFeeDueAmountForDisplayAttribute()
    {
        return $this->fee_due_amount != 0 ? number_format($this->fee_due_amount/100,2) : 0 ;
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
       return $this->belongsToMany('App\Models\Contact','contacts_memberships','membership_id','contact_id')
            ->withPivot('is_primary_contact');
   }    

}
