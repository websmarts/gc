<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Membership;
use Illuminate\Support\Str;
use App\Models\MembershipType;
use App\Events\NewEmailAddressRecorded;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use App\Traits\UserHasRolesTrait as HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contact extends Authenticatable
{
    use SoftDeletes;
    use HasFactory;
    use Notifiable;
    use Impersonate;
    use HasRoles;

    protected $guard = 'contact';

    protected $fillable = [
        'name',
        'organisation_id',
        'uuid',
        'address_id',
        'phone',
        'email',
        'email_verified_at',
        'password',
        'notes'

    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    /**
     * aliases for ability keys
     */
    protected $roleAliases = [
        'membership_manager' => [],
    ];

    /**
     * Lets route model binding to use uuid
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }


    /**
     * returns contact email if verified else null
     */
    public function verifiedEmailAddress()
    {
        return  !is_null($this->email_verified_at) && !empty($this->email) ? $this->email : null;
    }

   /**
    * Call when an email address is changed to ensure it is unverified
    */
    public function unverifyEmail($sendEmail = true)
    {
        
        
        $this->email_verification_token = Str::random(24);
        $this->email_verified_at = null;

        if ($sendEmail) {
            $this->sendEmailVerification();
        }
    }
    /**
     * Sends a verification email to the updated email address
     */
    public function sendEmailVerification()
    {
        if (!empty($this->email)) {
            event(new NewEmailAddressRecorded($this));
        }
    }
    /**
     * Call to register that email address has been verified
     */
    public function verifyEmail()
    {
        $this->email_verification_token = null;

        if (!empty($this->email) && is_null($this->email_verified_at)) {
            $this->email_verified_at = $this->freshTimestamp();
        }
    }

    public function listRoles()
    {
        return  $this->roles->implode('role', ',');
    }
    public function listMemberships()
    {
        return $this->memberships->implode('name', ',');
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function roles()
    {
        return $this->belongsToMany(RoleOption::class, 'organisation_roles', 'contact_id', 'role_id')->withPivot('organisation_id');
    }


    public function memberships()
    {
        return $this->belongsToMany(Membership::class, 'contacts_memberships', 'contact_id', 'membership_id')
            ->withPivot('is_primary_contact');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
