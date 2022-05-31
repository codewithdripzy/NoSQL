<?php
    require './php_modules/NoSQL.php';
    $app = new NoSQL();

    if(!$app->DbExists("plugin")){
        if($app->createDb("plugin")){
            $app->init('plugin');
        }
    }
    else{
        $app->init("plugin");
    }

    if(!$app->tableExists("users")){
        if($app->createTable("users")){
            echo "Table sucessfully created";
            createAccount($app);
        }
    }else{
        createAccount($app);
    }
    
    function createAccount($app){
        $data = array(
            "id" => 5,
            "username" => "Dripzy_ii",
            "email" => $_POST['email'],
            "password" => password_hash($_POST['password'], PASSWORD_BCRYPT),
            "token" => md5(rand(1000, 10000))
        );

        if($app->push('users', $data)){
            echo "Account sucessfully created!!!";
        }else{
            echo "Somethimg went wrong! That's all we know!";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - noSQL - login</title>
    <link rel="stylesheet" href="http://localhost/webUI/css/main.css">
    <link rel="stylesheet" href="http://localhost/webUI/css/style.css">
    <link rel="stylesheet" href="http://localhost/webUI/css/inputs.css">
    <link rel="stylesheet" href="http://localhost/webUI/css/layers.css">
    <link rel="stylesheet" href="http://localhost/webUI/css/webui.css">
    <link rel="stylesheet" href="http://localhost/webUI/css/alerts.css">
    <link rel="stylesheet" href="http://localhost/webUI/css/fonts.css">
    <link rel="stylesheet" href="http://localhost/webUI/css/layout.css">
    <link rel="stylesheet" href="http://localhost/webUI/css/widgets.css">
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="modal modal-50pc floating-modal">
            <span class="h2">Sign Up</span>
            <input type="email" name="email" id="email" class='width-50pc'>
            <input type="password" name="password" id="psw" class='width-50pc'>
            <button type="submit" class="width-inherit">Sign Up</button>
        </div>
    </form>
</body>
</html>