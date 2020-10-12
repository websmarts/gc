<?php

namespace App\Models;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use App\Traits\UserHasRolesTrait as HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{

    use HasFactory;
    use Notifiable;
    use Impersonate;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_admin',
        'uuid',
        'name',
        'email',
        'email_verified_at',
        'password',
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'is_admin',
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * is_admin Mutator - stops attribute being updated unless its null
     */
    public function setIsAdminAttribute($value)
    {
       if( is_null($this->is_admin) ){
        $this->attributes['is_admin'] = $value;
       }   
    }   

       
    
    /**
     * UUID Mutator - stops uuid being updated unless its null
     */
    public function setUuidAttribute($value)
    {
        if( !(isSet($this->attributes['uuid']) &&  $this->attributes['uuid']) ){
            $this->attributes['uuid'] = $value;
        }     
    }

    /**
     * Lets route model binding to use uuid
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }


    /**
     * Check if this user allowed to impersonate another user
     * @return bool
     */
    public function canImpersonate()
    {
        return $this->hasRole('system-administrator');
    }

    public function organisations()
    {
        return $this->belongsToMany('App\Models\Organisation', 'organisation_managers');
    }
}
