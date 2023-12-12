<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseContract
{
    const LIMIT = 10;
    const ORDER_BY = 'id';
    const ORDER_DIR = 'desc';

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes = []): mixed;

    /**
     * @param Model $model
     * @param array $attributes
     *
     * @return mixed
     */
    public function update(Model $model, array $attributes = []): mixed;

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function updateAll(array $attributes = []): mixed;

    /**
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function createOrUpdate(array $attributes = [], $id = null): mixed;

    /**
     * @param array $attributes
     * @param array $identifier
     *
     * @return mixed
     */
    public function defaultUpdateOrCreate(array $attributes, array $identifier = []): mixed;

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function remove(Model $model): mixed;

    public function canRemove(Model $model);

    /**
     * @param int $id
     * @param array $relations
     *
     * @return mixed
     */
    public function find(int $id, array $relations = []): mixed;

    /**
     * @param int $id
     * @param array $relations
     *
     * @return mixed
     */
    public function findOrFail(int $id, array $relations = []): mixed;

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    public function findBy(string $key, mixed $value): mixed;

    /**
     * @param mixed $fields
     *
     * @return mixed
     */
    public function findByFields(array $fields): mixed;

    /**
     * @param array $wheres
     * @param array|null $data
     * @return mixed
     */
    public function whereOrCreate(array $wheres, array $data = null): mixed;

    /**
     * @param string|null $labelField
     * @param string $valueField
     * @param bool $applyOrder
     * @param string $orderBy
     * @param string $orderDir
     * @param array $conditions
     *
     * @return mixed
     */
    public function findAllForFormSelect(
        string $labelField = null,
        string $valueField = 'id',
        bool   $applyOrder = false,
        string $orderBy = self::ORDER_BY,
        string $orderDir = self::ORDER_DIR,
        array $conditions = []
    ): mixed;

    /**
     * @param array $fields
     * @param bool $applyOrder
     * @param string $orderBy
     * @param string $orderDir
     * @return mixed
     */
    public function findAll(
        array  $fields = [],
        bool   $applyOrder = true,
        string $orderBy = self::ORDER_BY,
        string $orderDir = self::ORDER_DIR
    ): mixed;

    /**
     * @param array $filters
     * @param array $relations
     * @param bool $applyOrder
     * @param bool $page
     * @param int $limit
     * @param string $orderBy
     * @param string $orderDir
     * @param array $conditions
     * @param bool $customizePaginationURI
     * @param null $paginationURI
     * @param  $orderBy2
     * @param  $orderDir2
     * @return mixed
     */
    public function search(
        array  $filters = [],
        array  $relations = [],
        bool   $applyOrder = true,
        bool   $page = true,
        int    $limit = self::LIMIT,
        string $orderBy = self::ORDER_BY,
        string $orderDir = self::ORDER_DIR,
        array  $conditions = [],
        bool   $customizePaginationURI = false,
               $paginationURI = null,
               $orderBy2 = null,
               $orderDir2 = null
    ): mixed;

    /**
     * @param $query
     * @param bool $applyOrder
     * @param bool $page
     * @param int $limit
     * @param string $orderBy
     * @param string $orderDir
     * @param bool $customizePaginationURI
     * @param null $paginationURI
     * @return mixed
     */
    public function getQueryResult(
        $query,
        bool $applyOrder = true,
        bool $page = true,
        int $limit = self::LIMIT,
        string $orderBy = self::ORDER_BY,
        string $orderDir = self::ORDER_DIR,
        bool $customizePaginationURI = false,
        $paginationURI = null
    ): mixed;


    /**
     * Create a Pagination From Items Of  array Or collection.
     *
     * @param array|Collection $items
     * @param int $perPage
     * @param int|null $page
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public function paginate(array|Collection $items, int $perPage = 15, int $page = null, array $options = []): LengthAwarePaginator;

    /**
     * toggle boolean field in model.
     *
     * @param int $id
     * @param string $field
     *
     * @return mixed
     */
    public function toggleField(int $id, $field);
    public function createRowOrMultiRow(array $params , string $model);
}
