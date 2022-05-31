<?php
    require "bin/encryptor.php";

    $enc = new DBEncrytptor("plugin");
    echo $enc->encrypt("bankole emmanuel");
    echo $enc->decrypt(123455);
?>