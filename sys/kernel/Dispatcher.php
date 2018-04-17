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
    }

}

