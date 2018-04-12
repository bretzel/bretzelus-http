<?php


    define('DS'         ,DIRECTORY_SEPARATOR);
    define('ROOT'       ,$_SERVER['DOCUMENT_ROOT']);
    define('SYS'        ,ROOT.DS.'sys');
    define('KERNEL'     ,SYS.DS.'kernel');
    define('CSS'        ,SYS.DS.'css');
    define('CTRL'       ,ROOT.DS.'c');
    define('ControllerName' ,'C');
    require_once SYS.DS.'Includes.php';
    require_once KERNEL.DS.'Window.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bretzelus Portal</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/sys/css/main.css">

</head>
<body>
    <h1 id="MainTitle"> {{ Text }} </h1>
    <?php

    function Send(string $Msg)
    {
        echo "<p class='color-light'> &gt;&gt; $Msg</p>";
    }
        try {
            if(\App\Controller\Dispatcher::Dispatch()){
                Send("Request sucess!");
            }
            else {
                Send("Request failed!");
            }
        }
        catch(\Exception $e){
            echo "Exception: ".$e->getMessage();
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="/sys/js/Bretzelus.PortalApp.js"></script>
    <?php
    foreach(\App\Controller\Dispatcher::$Stack as $Msg) Send($Msg);
    ?>
</body>
</html>
