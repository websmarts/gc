<?php

namespace App\Models;


use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Lab404\Impersonate\Models\Impersonate;
use App\Traits\UserHasRolesTrait as HasRoles;



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
     * Lets route model binding to use uuid
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }


    // public function isAdministrator()
    // {
    //     return $this->is_admin == 1;
    // }




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
