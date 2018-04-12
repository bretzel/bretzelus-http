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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/sys/js/Elements.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/sys/css/main.css">


</head>


</head>
<body>
    <h1 id="MainTitle"> Portail </h1>
    <script>
        var r = {
            arg1 : "allo",
            arg2 : "Le World!",
            n    : 53
        }
        str = JSON.stringify(r);
        console.log(str);
    </script>
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


    <?php
    foreach(\App\Controller\Dispatcher::$Stack as $Msg) Send($Msg);
    ?>
    <div id="EventDlg"></div>
</body>
</html>
