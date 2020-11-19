<?php

namespace App\Models;

use App\Settings;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Membership;
use App\Models\MembershipType;
use App\Models\OrganisationRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organisation extends Model
{
    use HasFactory, SoftDeletes;

    // const SETTING_OPTIONS = [
    //     'payment_handler' => ['manual'], // Paypal,Stripe      
    // ];

    protected $fillable = [

        'name',
        'abn',
        'gst_registered',
        'address_id',
        'phone',
        'bank_account_details',
        'uuid',
        'slug',
        'settings',
    ];

    protected $dates = ['deleted_at'];

    protected $casts = ['settings' => 'json'];


    protected $allowedSettings = [
        'payment_handler', 
        'PAYPAL_USE_SANDBOX', 
        'PAYPAL_SANDBOX_CLIENT_ID',
        'PAYPAL_SANDBOX_CLIENT_SECRET',
        'PAYPAL_LIVE_CLIENT_ID',
        'PAYPAL_LIVE_CLIENT_SECRET'
    ];



    /**
     * Lets route model binding to use uuid
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Support for storing settings as JSON in settings attribute
     */
    public function settings()
    {
        return new Settings($this, $this->allowedSettings);
    }

    /**
     * Relationships
     */
    public function managers()
    {
        return $this->belongsToMany('App\Models\User', 'organisation_managers');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function membershipTypes()
    {
        return $this->hasMany(MembershipType::class);
    }

    public function memberships()
    {
        return $this->hasManyThrough(Membership::class, MembershipType::class);
    }

    public function roleOptions()
    {
        return $this->belongsToMany(RoleOption::class, 'organisation_roles', 'organisation_id', 'role_id')->withPivot('contact_id');
    }

    public function members($primary_contacts_only = false)
    {
        $query =  DB::table('contacts')
            ->select(
                'contacts.id as contact_id',
                'contacts.name',
                'contacts.phone',
                'contacts.email',
                'addresses.address1',
                'addresses.address2',
                'addresses.city',
                'addresses.postcode',
                'states.name as state',
                'contacts_memberships.is_primary_contact as is_primary_contact',
                'memberships.name as membership_name',
                'membership_types.id as membership_type_id',
                'membership_types.name as membership_type_name'
            )
            ->join('addresses', 'contacts.address_id', '=', 'addresses.id')
            ->join('states', 'addresses.state_id', '=', 'states.id')
            ->join('contacts_memberships', 'contacts_memberships.contact_id', '=', 'contacts.id')
            ->join('memberships', 'contacts_memberships.membership_id', '=', 'memberships.id')
            ->join('membership_types', 'memberships.membership_type_id', '=', 'membership_types.id')
            ->where('contacts.organisation_id', $this->id);

        if ($primary_contacts_only) {
            $query->where('is_primary_contact', 1);
        }

        return $query->get();
    }

    public function renewableMemberships()
    {
        return  $this->memberships
            ->filter(function ($membership) {
                return $membership->isRenewable();
            });
    }
    public function hasRenewableMemberships()
    {
        return $this->renewableMemberships()->count();
    }
}
