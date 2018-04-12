<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 18-04-10
 * Time: 12:48
 */

namespace App\Controller;



//require_once 'sys/kernel/Request.php';

class Test // extends Controller // Plus tard, l'on devra instancier un vrai Controller pour du vrai traitement ;=) ...
{
    public function Test() :bool{
        echo "<pre> Test::Test() : Je suis une pseudo reflexion....</pre>";
        return true;
    }

    public static function execute(?Object $Args) : bool
    {
        echo "<pre>Test::execute(\$Args) Args:\n"; print_r($Args); echo "</pre>";
        return true;
    }
};

function execute(?Object $Args):bool {
    return Test::execute($Args);
}

?>