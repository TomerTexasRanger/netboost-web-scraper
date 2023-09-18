<?php

namespace App\Services\Target;

use App\Models\Target;
use App\Services\Target\Crud\CreateService;
use App\Services\Target\Crud\EditService;
use App\Services\Target\Crud\IndexService;
use App\Services\Target\Crud\ShowService;
use App\Services\Target\Crud\StoreService;
use App\Services\Target\Crud\UpdateService;
use App\Services\Transaction\TransactionService;
use Exception;

class TargetService extends TransactionService
{

    protected Target $model;

    /**
     * @throws Exception
     */
    public static  function Store(array $data): StoreService
    {
        return new StoreService($data);
    }
}
