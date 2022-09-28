<?php

namespace ngdang\dto;

use ngdang\dto\interface\Arrayable;
use ngdang\dto\interface\Jsonable;

class Data implements Arrayable, Jsonable{

    use HasAttributes;

    public static function from(array $attributes = [])
    {
        $instance = new static();
        return $instance->setAttributes($attributes);
    }

    public static function collection(array $items): Collection
    {
        $items = array_map(function ($item) {
            if ($item instanceof static) {
                return $item;
            } else {
                return static::from($item);
            }
        }, $items);

        return new Collection($items);
    }

    public function toArray()
    {
        return $this->attributesToArray();

    }

    public function toJson($option=0)
    {
        return json_encode($this->toArray(), $option);
    }
}