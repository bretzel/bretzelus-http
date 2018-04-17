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


    public function __construct(Request $aReq)
    {
        parent::__construct($aReq);
    }

    public function View(){
        Dispatcher::Debug($this);
        $this->Render();
    }
}


?>

