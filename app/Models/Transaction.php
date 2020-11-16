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
        'type', // eg payment request, refund, adjustment, etc
        'regarding', // eg membership renewal
        'reference_id', // eg hashId of membership
        'gross_amount_charged', // gross invoice amount
        'transaction_id', // payment gateway transaction id
        'response_status_code', // eg 201 = all good
        'payee_name',
        'gross_amount_paid', // the amount actuall charged to the payee
        'net_amount_received', // eg after paypal takes their fee
        'when_received', // timestamp 
        'created_by', // user id if manually done or 0 = system
        'note', // eg why adjustment was made
    ];

    protected $dates = ['deleted_at'];
}
