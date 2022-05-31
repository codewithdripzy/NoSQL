<?php
    require './php_modules/NoSQL.php';
    $app = new NoSQL();
    $app->init('plugIn');

    // $app->createDb('PlugIn');
    // $app->createTable('users');
    session_start();
    
    echo "<pre>";
        print_r($_SESSION);
    echo "</pre>";

?>