<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 18-04-16
 * Time: 16:43
 */

namespace App\Controller;


class Router
{
    static function Parse(?Request $request=null):bool
    {
        if($request === null)
            return false;

        $params = explode('/',$request->Url());
        $request->controller = $params[0];
        $request->action = isset($params[1]) ? $params[1] : 'index';
        $request->params = array_slice($params,2);
//        Dispatcher::Debug([
//            "Raw       :" => $request->Url(),
//            "Controller:" => $request->ControllerName(),
//            "Action    :" => $request->Action(),
//            "Args      :" => $request->Args()
//        ]);
        //exit(0);
        return true;
    }
}

