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
    private $_Data;
    private $_Controler;
    private $_Args;

    /**
     * Request constructor.
     * @throws \Exception
     */
    public function __construct()
    {

        if(count($_POST))
            $this->_Data = $_POST;
        else {
            if (count($_GET)) {
                foreach($_GET as $K => $dummy)
                $this->_Data = json_decode($K);
                echo"<pre>Request::__construct this->_Data:\n";print_r($this->_Data); echo "</pre>";
                $this->_Controler = $this->_Data->C;
                //$this->_Args = $this->_Data->Args;
            }
            else {
                $this->_Data = null;
                throw new \Exception("Request: Empty (Debug: Request::Data == null)");
            }
        }

        if(!isset($this->_Data))
            throw new \Exception("Request: Empty (Debug: Request::Data['C'] unset)");

    }

    public function Args() : ?Object { return $this->_Data->Args; }
    public function ControllerName(): string { return $this->_Controler; }

}
