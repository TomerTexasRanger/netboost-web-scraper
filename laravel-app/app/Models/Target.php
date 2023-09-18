<?php

namespace App\Models;
use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\HasMany;
/**
 * @property string $_id
 * @property string $url
 * @property string $title
 * @property array{Link} $links
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Target extends Model
{
    protected $collection = 'targets';
    protected $fillable = ['url', 'title','links'];


    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }
}
