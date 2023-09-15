<?php

namespace App\Services\Target;

use App\Abstracts\CrudServiceAbstract;
use App\Services\Target\Crud\CreateService;
use App\Services\Target\Crud\EditService;
use App\Services\Target\Crud\IndexService;
use App\Services\Target\Crud\ShowService;
use App\Services\Target\Crud\StoreService;
use App\Services\Target\Crud\UpdateService;
use App\Traits\CrudTrait;

class TargetService extends CrudServiceAbstract
{
    use CrudTrait;

    static protected function crudServiceMapper(): array
    {
        return [
            'index' => IndexService::class,
            'show' => ShowService::class,
            'edit' => EditService::class,
            'store' => StoreService::class,
            'update' => UpdateService::class,
            'create' => CreateService::class,
        ];
    }
}
