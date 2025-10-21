<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = [
        'company_id',
        'user_id',
        'first_name',
        'last_name',
        'position',
        'email',
        'phone',
        'mobile',
        'notes'
    ];
}
