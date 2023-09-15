<?php

namespace App\Traits;

use App\Services\Transaction\TransactionService;
use Illuminate\Support\Facades\Cache;

trait CrudTrait
{

    public static function transaction()
    {
        TransactionService::begin();
        return new self();
    }


    public function commit()
    {
        TransactionService::commit();
        return $this;
    }

    public function flushCache(string|array $keys, string $cachePrefix = null)
    {
        if (is_string($keys)) Cache::forget($keys);
        else if (is_array($keys)) collect($keys)->map(fn($key) => Cache::forget($cachePrefix ? $cachePrefix . '-' . $key : $key));
        return $this;
    }
}
