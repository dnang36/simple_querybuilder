<?php

namespace ngdang\dto;

use ngdang\dto\connect\QueryBuilder;

abstract class model extends Data
{
    protected QueryBuilder $query;

    protected string $table = '';

    public static function __callStatic(string $name, array $arguments)
    {
        return (new static)->{$name}(...$arguments);
    }

    public function getQuery(): QueryBuilder
    {
        return $this->query;
    }

    public function setQuery(QueryBuilder $query)
    {
        $this->query = $query;
        return $this;
    }

    public static function query(QueryBuilder $query) {
        return (new static())->setQuery($query);
    }

    public function select(string|array $fields = '*') {
        $this->query->select($this->table, $fields);
        return $this;
    }

    public function all() {
        $data = $this->query->all();
        return static::collection($data);
    }


}