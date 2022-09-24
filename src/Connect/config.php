<?php

namespace ngdang\dto\connect;
use PDO;
use PDOException;

class config{

    public static function connect(array $config){
        try {
            $conn = new PDO("mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}", $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
//            $conn = new PDO("mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}",$config['username'], $config['password']);
//            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch (PDOException $e){
            return 'fail'.$e->getMessage();
        }
    }

//    public static function exQuery(string $query, array $config=[])
//    {
//        $p = new config();
//        $con = $p->connect($config);
//        $stmt = $con->prepare($query);
//        $stmt->execute();
//
//        while ($result = $stmt->fetchObject()){
//            print_r($result) ;
//        }
//    }
}



