<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 18-04-10
 * Time: 12:48
 */

namespace App\Controller;



//require_once 'sys/kernel/Request.php';

class TestController extends ControllerBase
{
    private $Req;

    public function __construct(Request $aReq)
    {
        parent::__construct($aReq);
        //Dispatcher::Debug($aReq);
    }


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    public function Calendar()
    {
        Dispatcher::Debug(array([
            " \App\Controller\Test::Calendar:" => " Testing ostie!",
            $this->RequestObj()->Action() => $this->RequestObj()->Args()
        ]), "function Test::Calendar:");
    }

    public function TestUI():bool
    {
        $Args = $this->RequestObj()->Args();
        if(!isset($Args))
            return false;

        Dispatcher::Debug(array([ $Args, $_GET]), "TestUI arguments");

        $E = $Args[0];
        $E = '\Ui\\'.$E;
        new $E(null,'TestUI');
        //Dispatcher::Debug($Args);

        return true;
    }
}


?>