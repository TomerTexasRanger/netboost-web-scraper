<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    protected $collection = 'links';
    protected $fillable = ['target_id','url'];

    public function target(): BelongsTo
    {
        return $this->belongsTo(Target::class);
    }
}
