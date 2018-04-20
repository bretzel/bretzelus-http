<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 18-04-17
 * Time: 09:53
 */

namespace App\Controller;



class ControllerBase
{
    private $Req;
    public  $Layout = 'Default';
    public function __construct(Request $aReq)
    {
        $this->Req = $aReq;
    }


    public function Render(string $View)
    {
        $view = VIEW.DS.$this->Req->ControllerName().DS.$View.'.php';
        if(!file_exists($view))
            Dispatcher::e404("Page introuvable");
        //ob_start()
        require $view ;
//        $contents = ob_get_clean();
        require VIEW.DS.'Layout'.DS.$this->Layout.'.php';
    }

    public function RequestObj():Request  { return $this->Req; }
}


?>

