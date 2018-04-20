<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 4/10/18
 * Time: 12:07 PM
 */

namespace App\Controller;


class Request
{
    var $controller;
    var $action;
    var $params;
    var $noPath = false;
    public $url;
    /**
     * Request constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        if(!isset($_SERVER['PATH_INFO'])){
            $this->noPath = true;
            return;
        }
        $this->url = trim($_SERVER['PATH_INFO'],'/');
    }

    public function ControllerName()    : ?string { return $this->controller; }
    public function Action()            : ?string { return $this->action; }
    public function Args()              : ?array { return $this->params; }
    public function Url()               : ?string { return $this->url; }
    public function Empty()             : bool   { return $this->noPath; }
}
