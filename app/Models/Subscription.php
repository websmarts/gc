<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;
    
    protected $fillable = [ 'membership_id','amount_charged','amount_received','payment_received_date','expiry_date'];

    protected $dates = ['deleted_at','payment_received_date','expiry_date'];

}
