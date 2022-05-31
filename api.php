<?php
    if($_REQUEST){
        if(isset($_REQUEST['email']) && !empty($_REQUEST['email'])){
            require 'bin/NoSQL.php';
            
            $app = new NoSQL();
            $app->init('plugin');

            if($app->tableExists('users')){
                $stmt = $app->pull('users', 'email', $_REQUEST['email']);
                print_r(json_encode($stmt));
            }
        }
    }

?>