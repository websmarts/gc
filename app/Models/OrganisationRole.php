<?php

namespace App\Models;

use App\Models\Contact;
use App\Models\RoleOption;
use App\Models\Organisation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganisationRole extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'organisation_roles';

    protected $fillable = [
        'organisation_id',
        'contact_id',
        'role_id'
    ];

    // public function organisation()
    // {
    //     return $this->belongsTo(Organisation::class);
    // }

    public function role()
    {
        return $this->belongsTo(RoleOption::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
