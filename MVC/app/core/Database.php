<?php

class Database{
    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh, //database handler
            $stmt; //statement
    public function __construct(){
        // data source name
        $dsn = 'mysql:host=' . $this->db_host .';dbname='. $this->db_name;

        $option = [
            PDO::ATTR_PERSISTENT => true, //For Securing Connection
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //For Error Handling
        ];

        try{
            // PHP Data Objects
            $this->dbh = new PDO($dsn, $this->db_user, $this->db_pass, $option);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type=null){
        if(is_null($type)){
            switch (true){
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }

        // Query getting executed after string getting binded
        // Makes it more safer,  as it prevents SQL Injection
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        $this->stmt->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }
}
