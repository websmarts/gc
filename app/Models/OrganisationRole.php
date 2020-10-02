<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisationRole extends Model
{
    use HasFactory;


    protected $fillable = [
        'organisation_id',
        'contact_id',
        'role_id'
    ];
}
