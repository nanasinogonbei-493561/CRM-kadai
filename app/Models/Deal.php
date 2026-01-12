<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    //
    protected $fillable = [
        'company_id',
        'contact_id',
        'user_id',
        'title',
        'amount',
        'status',
        'date',
        'probability',
        'description',
        'notes'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
