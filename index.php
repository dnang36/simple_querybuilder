<?php

require 'vendor/autoload.php';
use src\query\queryBuilder;

$quey = queryBuilder::table('123')->select('cot 1','cot 2')->orWhere('cot2','=','20')->where('cot1','>','30')->get();
echo $quey;