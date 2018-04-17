<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 4/10/18
 * Time: 11:26 AM
 */

namespace App\Controller;


class Dispatcher
{

    var $req;
    public static $Stack;
    public static function PushMessage(string $Msg){
        Dispatcher::$Stack[] = $Msg;
    }
    public function __construct()
    {
        $this->req = new Request();
        Router::Parse($this->req->url, $this->req);
        $controller = $this->LoadController();
        $controller->view();
    }

    public static function Debug($Stuff)
    {
        echo "<pre>"; print_r($Stuff); echo "</pre>";
    }

    private function LoadController():object
    {
        $name = ucfirst($this->req->controller).'Controller';
        $file = CTRL.DS.$name.'.php';
        require_once $file;
        echo "<br><br>";
//        Dispatcher::Debug(array('Controller:' => $name, 'File:' => $file));
        $name = '\App\Controller\\'.$name;
        return new $name();
    }

}

