<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'address',
        'postal_code',
        'city',
        'industry',
        'description',
        'notes',
    ];
}
