<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 4/10/18
 * Time: 8:46 AM
 */

namespace Ui;

require_once 'Element.php';

class Window extends Element
{

    private $Caption = [];
    public function __construct(?Element $aParent = null, ?string $aId = null)
    {
        parent::__construct($aParent, $aId, 'div');
        $this->cssClass("FWindow");
    }




}
