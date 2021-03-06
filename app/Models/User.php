<?php

namespace App\Models;

use App\Models\Organisation;
use Laravel\Sanctum\HasApiTokens;
use \App\Traits\UserHasRolesTrait;
use Illuminate\Support\Facades\Cache;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use userHasRolesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'uuid'
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
        'last_selected_organisation_uuid',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function selectedOrganisation()
    {
       if(! is_null($this->last_selected_organisation_uuid)) {

           return Cache::remember('selected_organisation_'.$this->last_selected_organisation_uuid, 60, function()
           {
               return $this->organisations()->where('uuid',$this->last_selected_organisation_uuid)->get()->first();
           });
       }

       $this->last_selected_organisation_uuid = $this->organisations->first()->uuid;
       $this->save();
       return cache::remember('selected_organisation'.$this->last_selected_organisation_uuid,60,function(){
            return $this->organisations()->where('uuid',$this->last_selected_organisation_uuid)->get()->first();
       });
    }
   
    /**
     * Model relationships
     */

     public function organisations()
     {
        return $this->belongsToMany('App\Models\Organisation', 'organisation_managers');
     }

    
}
