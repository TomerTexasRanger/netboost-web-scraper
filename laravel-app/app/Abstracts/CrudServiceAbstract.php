<?php

namespace App\Abstracts;

use App\Interfaces\CrudServiceInterface;
use Illuminate\Database\Eloquent\Model;

abstract class CrudServiceAbstract implements CrudServiceInterface
{

    /**
     * @var Model|null
     */
    protected ?Model $model = null;
    /**
     * @var array | object
     */
    protected array|object $data = [];

    abstract static protected function crudServiceMapper(): array;

    public static function Index(array $criteria, mixed $extend = null)
    {
        $serviceClass = static::crudServiceMapper();
        return new $serviceClass['index']($criteria, $extend);
    }

    public static function Show($model, $data = [])
    {
        $serviceClass = static::crudServiceMapper();
        return new $serviceClass['show']($model, $data);
    }

    public static function Create()
    {
        $serviceClass = static::crudServiceMapper();
        return new $serviceClass['create']();
    }

    public static function Store(array $data)
    {
        $serviceClass = static::crudServiceMapper();
        return new $serviceClass['store']($data);
    }

    public static function Edit($model)
    {
        $serviceClass = static::crudServiceMapper();
        return new $serviceClass['edit']($model);
    }

    public static function Update($model, array $data)
    {
        $serviceClass = static::crudServiceMapper();
        return new $serviceClass['update']($model, $data);
    }

    public static function Destroy($model, array $data = [])
    {
        $serviceClass = static::crudServiceMapper();
        return new $serviceClass['destroy']($model, $data);
    }
}
