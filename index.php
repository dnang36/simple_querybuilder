<?php

require 'vendor/autoload.php';
use src\query\queryBuilder;

$quey = queryBuilder::table('user')
    ->select('name','email')
    ->join('user_order','user.id','=','user_order.user_id','right')
//    ->orderby('id','DESC')
//    ->limit(3)
//    ->where('id','=','3')
    ->get();

//echo $quey;
