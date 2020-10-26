<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [ 'address1','address2','city','postcode','state_id'];

    protected $dates = ['deleted_at'];

    public function getFullAddressAttribute()
    {
        return "{$this->address1} {$this->address2}, {$this->city} {$this->postcode} {$this->state->name}";
    }


    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }
}
