<?php

namespace ngdang\dto\interface;

use ngdang\dto\interface\Traversable;

interface IteratorAggregate extends Traversable {

    public function getIterator();
}