<?php

namespace ngdang\dto;

use ngdang\dto\interface\CollectionInterface;

class Collection implements CollectionInterface{

    private array $element;

    public function __construct($element)
    {
        $this->element=$element;
    }

    public function __toString()
    {
        return self::class . '@' . spl_object_hash($this);
    }

    protected function createFrom(array $elements)
    {
        return new static($elements);
    }


    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
        return isset($this->element[$offset]);
    }

    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
        return $this->element[$offset];
    }

    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
        return isset($this->element[$offset]);
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
        $this->element[$offset]=$value;
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
        return $this->attributesToArray();
    }

    public function isEmty()
    {
        // TODO: Implement isEmty() method.
        return empty($this->element);
    }

    public function filter(\Closure $callback)
    {
        // TODO: Implement filter() method.
        return $this->createFrom(array_filter($this->elements, $callback, ARRAY_FILTER_USE_BOTH));
    }

    public function clear()
    {
        // TODO: Implement clear() method.
        $this->element=[];
    }

    public function add($element)
    {
        // TODO: Implement add() method.
        $this->element[] = $element;
        return true;
    }

    public function first()
    {
        // TODO: Implement first() method.
        return reset($this->element);
    }

    public function last()
    {
        // TODO: Implement last() method.
        return end($this->element);
    }

    public function map(\Closure $callback)
    {
        // TODO: Implement map() method.
        return $this->createFrom(array_map($callback, $this->elements));
    }

    public function count()
    {
        // TODO: Implement count() method.
        return count($this->element);
    }

    public function getIterator()
    {
        // TODO: Implement getIterator() method.
        return new \ArrayIterator($this);
    }
}