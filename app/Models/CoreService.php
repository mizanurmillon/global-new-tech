<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreService extends Model
{
    protected $guarded = [];

    protected $casts = [
        'id'         => 'integer',
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function subServices()
    {
        return $this->hasMany(SubService::class);
    }

    public function serviceValues()
    {
        return $this->hasMany(ServiceValue::class);
    }

    public function howToWorkServices()
    {
        return $this->hasMany(HowToWorkService::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
