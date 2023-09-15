<?php

namespace App\Services\Transaction;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;

class TransactionService
{
    protected Session  $session;
    public function begin(): void
    {
        if (!$this->session->isInTransaction()) {
            $this->session = DB::getMongoClient()->startSession();
            $this->session->startTransaction();

        }
    }

    public function commit(): void
    {
        $this->session->commitTransaction();
    }

    public function rollback(): void
    {
        $this->session->abortTransaction();
    }

    public function getSession(): Session
    {
        return $this->session;
    }

    public function flushCache(string|array $keys, string $cachePrefix = null): static
    {
        if (is_string($keys)) Cache::forget($keys);
        else if (is_array($keys)) collect($keys)->map(fn($key) => Cache::forget($cachePrefix ? $cachePrefix . '-' . $key : $key));
        return $this;
    }
}
