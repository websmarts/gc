<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'type', // eg invoice, refund, adjustment, etc
        'regarding', // eg [membership/account] renewal
        'membership_id', // eg membership_id
        'organisation_id', // organisation_id
        'gross_amount_charged', // gross invoice amount
        'processors_transaction_id', // payment gateway transaction id
        'response_status_code', // eg 201 = all good
        'payee_name',
        'gross_amount_paid', // the amount actuall charged to the payee
        'net_amount_received', // eg after paypal takes their fee
        'when_received', // timestamp 
        'created_by', // user id if manually done or 0 = system
        'note', // eg why adjustment was made
    ];

    protected $dates = ['deleted_at','when_received'];
}
