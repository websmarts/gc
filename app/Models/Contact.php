<?php

namespace App\Models;
use App\Models\Address;
use App\Models\Membership;
use App\Models\MembershipType;
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
        'address_id',
        'phone',
        'email',
        'email_verified_at',
        'password',
        
    ];

    protected $hidden = [
        'password','remember_token',
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


    
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }


    public function memberships()
    {
        return $this->belongsToMany(Membership::class,'contacts_memberships','contact_id','membership_id')
                ->withPivot('is_primary_contact');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
