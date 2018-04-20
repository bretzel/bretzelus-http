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
        if($req->Empty()) {
            Dispatcher::PushMessage(" &rarr;No Request, No Route.");
            return false;
        }
        Router::Parse($req);
        $controller = Dispatcher::LoadController($req);
        $Action = $req->action;
        $controller->$Action();
        return true;
    }

    /**
     * Dispatcher constructor.
     * @throws \Exception si instanciée!
     */
    public function __construct()
    {
        throw new \Exception("&larr; \App\Controller\Dispatcher ne peut être instancié.");
    }

    public static function Debug($Stuff, ?string $Title=null )
    {
        if(isset($Title))
            echo  "<h2>$Title</h2><pre>";
        else
            echo "<pre>";
        print_r($Stuff);

        echo "</pre>";
    }

    private static function LoadController(Request $R):object
    {
        try {
            $name = ucfirst($R->controller) . 'Controller';
            $file = CTRL . DS . $name . '.php';
            if(!file_exists($file))
                Dispatcher::e404("Page introuvable.");
            include $file;
            $name = '\App\Controller\\' . $name;
            return new $name($R);
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

