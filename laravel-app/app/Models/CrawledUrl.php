<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class CrawledUrl extends Model
{
    protected $collection = 'crawled_urls';
    protected $fillable = ['url', 'name','links'];
}
