<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowToWorkService extends Model
{
    protected $guarded = [];

    protected $casts = [
        'id'              => 'integer',
        'core_service_id' => 'integer',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
    ];

    public function coreService()
    {
        return $this->belongsTo(CoreService::class);
    }
}
