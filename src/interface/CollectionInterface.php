<?php

namespace ngdang\dto\interface;

use ngdang\dto\interface\Countable;
use ngdang\dto\interface\IteratorAggregate;
use ngdang\dto\interface\ArrayAccess;
use ngdang\dto\interface\Arrayable;

interface CollectionInterface extends Countable, IteratorAggregate, ArrayAccess, Arrayable  {

    public function isEmty();

    public function filter(\Closure $callback);

    public function clear();

    public function add($element);

    public function first();

    public function last();

    public function map(\Closure $callback);

}