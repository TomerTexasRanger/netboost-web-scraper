<?php

namespace App\Interfaces;

interface CrudServiceInterface
{
    /**
     * Show for DataTable pagination
     * or list of items
     * @param array $criteria
     */
    public static function Index(array $criteria);

    /**
     * Show items
     * @param $model
     */
    public static function Show($model);

    /**
     * Prepare data before store
     */
    public static function Create();

    /**
     * Save new Item
     * @param array $data
     */
    public static function Store(array $data);

    /**
     * Prepare data before update
     * @param $model
     */
    public static function Edit($model);

    /**
     * Update Item
     * @param $model
     * @param array $data
     */
    public static function Update($model, array $data);

    /**
     * Delete Item
     * @param $model
     */
    public static function Destroy($model);

    /**
     * Begin Transaction for save, update or delete functions
     * @return mixed
     *
     * @example use for this function:
     *
     *  transaction() {
     *      TransactionService::begin();
     *      return new self();
     *  }
     *
     * @example for Save function:  ModelService::transaction()::Store($data)->commit();
     */
    public static function transaction();

    /**
     * Commit Transaction for save, update or delete functions
     * @return mixed
     *
     * @example use for this function:
     *
     *  commit() {
     *      TransactionService::commit();
     *      return $this;
     *  }
     *
     */
    public function commit();
}
