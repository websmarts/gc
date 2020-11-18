<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipRenewal extends Model
{
    use HasFactory;

    protected $fillable = [
        'membership_id',
        'transaction_id',
        'issued_date',
        'response_date'
    ];

    protected $dates = ['deleted_at','issued_date'];

    public function membership()
    {
        return $this->belongsTo('App\Models\Membership');
    }

    public function transaction()
    {
        return $this->hasOne('App\Models\Transaction');
    }

    


}
