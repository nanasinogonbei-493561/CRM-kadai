<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
        'company_name',
        'contact_name',
        'email',
        'phone',
        'phone_ng',
        'rank',
        'status',
        'deal_status',
        'last_sales_status',
        'email_notes',
        'call_notes',
        'notes',
    ];

    protected $casts = [
        'phone_ng' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
