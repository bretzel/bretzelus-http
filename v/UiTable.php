<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 18-04-19
 * Time: 13:10
 */

namespace Ui;

/**
 * Class UiRow Ligne r&eacuteguli&egrave;re d'une table
 * @package Ui
 */
class UiRow extends Element{
    public function __construct(Element $aParent, ?string $aId = null)
    {
        parent::__construct($aParent, $aId, 'tr');
    }


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}

/**
 * Class uiTHead Ligne d'en-t&ecirc;te.
 * @package Ui
 */
class uiTHead extends Element
{
    public function __construct(?Element $aParent = null, ?string $aId = null)
    {
        parent::__construct($aParent, $aId, 'thead');
    }
}

class UiTFoot extends Element
{
    public function __construct(?Element $aParent = null, ?string $aId = null)
    {
        parent::__construct($aParent, $aId, 'tfoot');
    }
}

class uiColumn extends Element
{
    private $RowSpan = 1;
    private $ColSpan = 1;
    private $Coltag  = 'td';

    public function __construct(?Element $aParent = null, ?string $aId = null, ?string $aTag = 'div')
    {
        parent::__construct($aParent, $aId, 'td');
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}
class UiTable extends Element
{
    public function __construct(?Element $aParent = null, ?string $aId = null)
    {
        parent::__construct($aParent, $aId, 'table');
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}