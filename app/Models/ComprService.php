<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComprService extends Model
{
    
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'is_active',
    ];
    protected $casts = [
        'id'                => 'integer',
        'is_active'         => 'boolean',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',

    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
