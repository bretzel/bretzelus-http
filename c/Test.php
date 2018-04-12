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
    public static function execute(Request $aRequest) : bool
    {
        echo"<pre>Test::execute:\n"; print_r($aRequest); echo "</pre>";
        echo "<pre>::"; print_r($aRequest->Args()) ; echo "</pre>";
        $Args = json_decode($aRequest->Args(),true); // Strictement un tableau associatif.
        echo"php::json_decode: <pre>[ '"; print_r($Args) ; echo "' ]</pre>";
        echo "Test.php::execute : <ul> <li>Nom du contr&ocirc;leur: `".$aRequest->ControllerName()."` </li><li>Argument(s): `". $aRequest->Args(). "`</li></ul>";
        return true;
    }
};

function execute(Request $aRequest):bool { return Test::execute($aRequest); }

?>