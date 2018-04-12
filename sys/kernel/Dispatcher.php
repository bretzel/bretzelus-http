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

    public static $Stack;
    public static function PushMessage(string $Msg){
        Dispatcher::$Stack[] = $Msg;
    }
    public function __construct()
    {
        throw new \Exception("Dispatcher::__construct : Le Dispatcher ne peut pas être instancié! (Erreur interne...)");
    }

    public static function Dispatch() : bool
    {
        try{
            Dispatcher::$Stack = [];
            $Req = new Request();
            $R = CTRL.DS.$Req->ControllerName().'.php'; // Merci, GrafikArt ;)
            Dispatcher::PushMessage("Dispatcher::Dispatch: Controller Location:[ ".$R.' ]');
            require $R;
            // One-shot : Pas de probs. "execute" n'est instancié qu'une fois et php termine après....
            return execute($Req->Args());
        }
        catch(\Exception $e) {
            Dispatcher::PushMessage("Catched in Dispatcher::Dispatch:".$e->getMessage());
            return false;
        }
        return true;
    }
}

