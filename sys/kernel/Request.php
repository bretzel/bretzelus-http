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
            if (count($_GET))
                $this->_Data = $_GET;
            else {
                $this->_Data = null;
                throw new \Exception("Request: Empty (Debug: Request::Data == null)");
            }
        }

        if(!isset($this->_Data['C']))
            throw new \Exception("Request: Empty (Debug: Request::Data['C'] unset)");

        $this->_Controler = isset($this->_Data['C']) ? $this->_Data['C'] : '';
        $this->_Args = isset($this->_Data['Args']) ? $this->_Data['Args'] : null;

    }

    public function ControllerName(): string { return $this->_Controler; }
    public function Args(): ?string { return $this->_Args; }
}
