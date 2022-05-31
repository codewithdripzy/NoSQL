<?php

// this is a file that decrypta data file into machine format at default ad convers it back to a readable format as response whEn needed

    class DBEncrytptor{
        private $encoding_keys = array(
            "a" => "",
            "b" => "",
            "c" => "",
            "d" => "",
            "e" => "",
            "f" => "",
            "g" => "",
            "h" => "",
            "i" => "",
            "j" => "",
            "k" => "",
            "l" => "",
            "m" => "",
            "n" => "",
            "o" => "",
            "p" => "",
            "q" => "",
            "r" => "",
            "s" => "",
            "t" => "",
            "u" => "",
            "v" => "",
            "w" => "",
            "x" => "",
            "y" => "",
            "z" => "",
            "1" => "",
            "2" => "",
            "3" => "",
            "4" => "",
            "5" => "",
            "6" => "",
            "7" => "",
            "8" => "",
            "9" => "",
            "0" => "",
            "!" => "",
            "@" => "",
            "#" => "",
            "$" => "",
            "%" => "",
            "^" => "",
            "&" => "",
            "*" => "",
            "(" => "",
            ")" => "",
            "_" => "",
            "+" => "",
            "=" => "",
            "-" => "",
            "`" => "",
            "~" => "",
            "." => "",
            "," => "",
            "<" => "",
            ">" => "",
            "/" => "",
            "?" => "",
            "\\" => "",
            "|" => "",
            "\"" => "",
            "'" => "",
            "]" => "",
            "[" => "",
            "{" => "",
            "}" => "",
            ":" => "",
            ";" => "",
            " " => "",
        );

        private $file_path;
        private $res;
        
        function __construct($db_name)
        {
            $this->file_path = __DIR__ . "/data/" . $db_name . ".json";
        }

        function encrypt(){
            $data = file_get_contents($this->file_path);
            $encrypted_data = "";
            for($i = 0; $i < strlen($data); $i++){
                if(key_exists($data[$i], $this->encoding_keys)){
                    $encrypted_data .= $this->encoding_keys[$data[$i]];
                }
            }
            // echo $encrypted_data;
            // echo dechex(bin2hex('}'));
            // echo hex2bin(hexdec('4c791'));
        }

        final function decrypt($access_token){
            
        }
        function calculate_hash(){
            $this->res = hash("sha256", decbin($this->current_value));
        }
    } 
?>