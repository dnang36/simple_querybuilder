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

//$query->insert('user',[
//    ['name','address'],
//    ["hung","thai binh"]
//])->go();
//
//$query->update('user',[
//    'name'=>'hưng chim ưng',
//    'address'=>'thái bình'
//    ])->where([['id','=',21]])
//    ->go();

//$query->delete('user')
//    ->where([['id','=',18]])
//    ->go();

$result = $query->select('user')
//    ->where([['id','>',2]])
//    ->limit(3)
    ->all();
print_r($result);

$user = ngdang\dto\test\user::query($query)->select()->all();
//print_r($user);