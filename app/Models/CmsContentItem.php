<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsContentItem extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

     protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function content()
    {
        return $this->belongsTo(CmsContent::class, 'content_id');
    }
}
