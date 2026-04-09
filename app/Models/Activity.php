<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'company_id',
        'contact_id',
        'deal_id',
        'user_id',
        'type',
        'title',
        'description',
        'date',
        'status',
        'phone_ng',
        'last_sales_status',
        'email_notes',
        'call_notes',
    ];

    protected $casts = [
        'phone_ng' => 'boolean',
        'date' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
