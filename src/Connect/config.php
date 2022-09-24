<?php

namespace src\connect;
use PDO;
use PDOException;

class config{

    private $HOST = "localhost";
    private $USERNAME = "root";
    private $PASSWORD = "12345678";
    private $DB_NAME = "pdotest";

    public function connect(){
        try {
            $conn = new PDO("mysql:host=$this->HOST;dbname=$this->DB_NAME",$this->USERNAME,$this->PASSWORD);

            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch (PDOException $e){
            return 'fail'.$e->getMessage();
        }
    }

    public static function exQuery($query)
    {
        $p = new config();
        $conn = $p->connect();
        $stmt = $conn->prepare($query);
        $stmt->execute();

        while ($result = $stmt->fetchObject()){
            print_r($result) ;
        }
    }

}