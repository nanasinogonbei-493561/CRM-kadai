<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    //
    protected $fillable = [
        'company_id',
        'user_id',
        'title',
        'amount',
        'status',
        'date',
        'probability',
        'description',
        'notes'
    ];
}
