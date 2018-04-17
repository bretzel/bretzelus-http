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


    public static function Dispatch():bool
    {
        $req = new Request();
        Router::Parse($req->url, $req);
        $controller = Dispatcher::LoadController($req);
        $Action = $req->action;
        $controller->$Action();
        return true;
    }

    public function __construct()
    {
        throw new \Exception("&larr; \App\Controller\Dispatcher ne peut être instanciée.");
//        $this->req = new Request();
//        Router::Parse($this->req->url, $this->req);
//        $controller = $this->LoadController();
//        $Action = $this->req->action;
//        $controller->$Action();
    }

    public static function Debug($Stuff)
    {
        echo "<pre>"; print_r($Stuff); echo "</pre>";
    }

    private static function LoadController(Request $R):object
    {
        try {
            $name = ucfirst($R->controller) . 'Controller';
            $file = CTRL . DS . $name . '.php';
            if(!file_exists($file))
                Dispatcher::e404("Page introuvable.");
            require_once $file;
            $name = '\App\Controller\\' . $name;
            return new $name();
        }
        catch(\Exception $e){
            Dispatcher::PushMessage($e->getMessage());
        }
    }


    public static function e404(string $Msg)
    {
        die($Msg);
    }
}

