<?php

    class DbConstructor{
        private $dbname;
        private $db_path;

        function __construct($dbname = null)
        {
            $this->dbname = $dbname;
        }

        function construct($filename){

            $this->dbname = strtolower($filename);
            $this->db_path = __DIR__ . '/data/' . strtolower($filename) . ".json";
            
            if(file_exists($this->db_path)){
                echo 'Unable to create database. Database is already existing';
                return false;
            }
            else{
                // $default_data = "{\n    \"" . strtolower($filename) . "\" : {\n\n    }\n}";
                $default_data = array();
                $default_data[$filename] = array();
                $default_data['*'] = array();
                $default_data['*']['encryption'] = 'sha256';
                $compiledData = json_encode($default_data);

                print($compiledData);

                if(file_put_contents($this->db_path, $compiledData)){
                    echo 'Database has been created sucessfully!';
                    return true;
                }
                else{
                    return false;
                }
            }
            return true;
        }
        function setDbPath($dbpath){
            $this->db_path = strtolower($dbpath);
        }

        function createTable($table_name){ 
            // "\n    \"" . $table_name . "\" : {\n\n    }\n"
            $default_table_format = array(
                $table_name => []
            );

            if(file_exists($this->db_path)){
                $existing_data = file_get_contents($this->db_path);
                $decoded_data = json_decode($existing_data, true);

                if(isset($decoded_data) && !empty($decoded_data)){
                    if(!key_exists($table_name, $decoded_data)){
                        $decoded_data[$table_name] = array(); 
                        
                        file_put_contents($this->db_path, json_encode($decoded_data));
                    }
                }
                else{
                    file_put_contents($this->db_path, json_encode($default_table_format));
                }
                return true;
            }
            else{
                return false;
            } 
        }

        function push($table_name, $data){
            if(file_exists($this->db_path)){
                $existing_data = file_get_contents($this->db_path);
                $decoded_data = json_decode($existing_data, true);
                
                if($this->tableExists($table_name)){
                    $decoded_data[$table_name][] = $data;
                }

                if(file_put_contents($this->db_path, json_encode($decoded_data))){
                    echo "<pre>";
                        print_r($decoded_data);
                    echo "</pre>";
                }
                
                // echo 'Tables has been sucess full created';
                // check if table exists
                
                return true;
            }else{
                return false;
            }
        }
        function pull($table_name, $key, $value){
            if(isset($this->db_path) && !empty($this->db_path)){
                if(file_exists($this->db_path)){

                    $existing_data = file_get_contents($this->db_path);
                    $decoded_data = json_decode($existing_data, true);

                    if($this->tableExists($table_name)){
                        if(array_key_exists($table_name, $decoded_data)){
                            $fetched_data = array();
                            
                            for($i = 0; $i < count($decoded_data[$table_name]); $i++){
                                if(key_exists($key, $decoded_data[$table_name][$i])){
                                    if($decoded_data[$table_name][$i][$key] == $value){
                                        $fetched_data[] = $decoded_data[$table_name][$i];
                                    }
                                }
                            }
                            
                            return $fetched_data;
                        }
                    }
                }
                return false;
            }
            return false;
        }

        function delete(){

        }
        function update(){

        }

        function tableExists($table_name){
            if(isset($this->db_path) && !empty($this->db_path)){
                if(file_exists($this->db_path)){
                    $existing_data = file_get_contents($this->db_path);
                    $decoded_data = json_decode($existing_data, true);
                    
                    if(isset($decoded_data) && !empty($decoded_data)){
                        if(key_exists($table_name, $decoded_data)){
                            return true;
                        }
                    }
                }
                return false;
            }
            return false;
        }
    }

?>