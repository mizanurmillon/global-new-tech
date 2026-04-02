<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityAssessment extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'company_name',
        'security_interest',
        'company_size',
        'timeline',
        'budget_range',
        'message',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
