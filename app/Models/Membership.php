<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    use  SoftDeletes;
    
    protected $fillable = [
        'name',
        'organisation_id',
        'membership_type_id',
        'start_date',
        'status'
    ];

    protected $dates = ['start_date','deleted_at'];



   

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
