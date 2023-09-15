<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model;

class Target extends Model
{
    protected $collection = 'targets';
    protected $fillable = ['url', 'name','links'];


    public function links()
    {
        return $this->hasMany(Link::class);
    }
}
