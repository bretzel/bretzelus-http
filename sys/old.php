<?php
    define('DS'         ,DIRECTORY_SEPARATOR);
    define('ROOT'       ,$_SERVER['DOCUMENT_ROOT']);
    define('SYS'        ,ROOT.DS.'sys');
    define('KERNEL'     ,SYS.DS.'kernel');
    define('CSS'        ,SYS.DS.'css');
    define('CTRL'       ,ROOT.DS.'c');
    define('DATA'       ,ROOT.DS.'m');
    define('VIEW'       ,ROOT.DS.'v');
    require_once SYS.DS.'Includes.php';
    require_once VIEW . DS . 'Window.php';


    function WriteP(string $Msg)
    {
        \App\Controller\Dispatcher::PushMessage("<p class='color-light'> &gt;&gt; $Msg</p>");
    }


    try {
        if(! \App\Controller\Dispatcher::Dispatch())
            require VIEW . DS . 'Layout' . DS . 'index.php';
    else
        WriteP("Request success!");
    }
    catch(\Exception $e){
        WriteP("Exception: ".$e->getMessage());
    }
    // Debug:
    foreach(\App\Controller\Dispatcher::$Stack as $Msg) echo $Msg;
?>
