<?php

require 'vendor/autoload.php';

$config = [
    'host' => 'localhost',
    'dbname' => 'pdotest',
    'charset' => 'utf8',
    'username' => 'root',
    'password' => '12345678',
];

use ngdang\dto\connect\QueryBuilder;
use ngdang\dto\connect\config;

$query = new QueryBuilder(config::connect($config));


$insert = $query->insert('user',[
    ['name','address'],
    ["hung","thai binh"]
])->go();

$query->update('user',[
    'name'=>'hưng chim ưng',
    'address'=>'thái bình'
    ])->where([['id','=',21]])
    ->go();

//$query->delete('user')
//    ->where([['id','=',16]])
//    ->go();

$result = $query->select('user')
//    ->where([['id','>',2]])
//    ->limit(3)
    ->all();
print_r($result);


