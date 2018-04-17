<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 18-04-17
 * Time: 09:55
 */

namespace App\Controller;


class PagesController extends ControllerBase
{
    private $Name;
    private $Params = [];
    public function View(){
        Dispatcher::Debug($this);
    }
}


?>

