<?php
    // include_once './config/system.php';
    // include_once './config/preference.php';
    include_once 'constructor.php';

    class NoSQL{
        private $constructor;
        private $db_path;

        function __construct()
        {
            $this->constructor = new DbConstructor();
            
            // fetch all preferance , setting and configs and check for errors;
        }
        function init($db_name){
            $this->db_path = __DIR__ . "/data/{$db_name}.json";
            $this->constructor->setDbPath($this->db_path);
        }

        
        function createDb(string $db_name){
            // let the constructor create a new JSON file named after the $table_name variable
            $this->db_path = __DIR__ . "/data/{$db_name}.json";
            if(file_exists($this->db_path)){
                echo "Unable to create database, there is an existing database named {$db_name}";
            }
            else{
                if($this->constructor->construct($db_name)){
                    return true;
                }
            }
        }

        function DbExists(string $db_name){
            $this->db_path = __DIR__ . "/data/{$db_name}.json";
            
            if(file_exists($this->db_path)){
                return true;
            }
            else{
                return false;
            }
        }

        function createTable($table_name){
            if(!isset($this->db_path) && empty($this->db_path)){
                echo 'No Database found. initialize your database';
            }
            else{
                if($this->constructor->createTable($table_name)){
                    return true;
                }
            }
            return false;
        }

        function tableExists($table_name){
            if($this->constructor->tableExists($table_name)){
                return true;
            }
            return false;
        }

        function push($table_name, $data){
            if($this->constructor->tableExists($table_name)){
                $this->constructor->push($table_name, $data);
                return true;
            }
            return false;
        }
        
        function pushOne(){

        }

        function pull($table_name, $key, $value){ 
            if($this->constructor->tableExists($table_name)){
                $data = $this->constructor->pull($table_name, $key, $value);
                return $data;
            }
            return false;
        }

    }

?>