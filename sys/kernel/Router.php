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
    static function Parse(string $url, Request $request):bool
    {
        $url = trim($url,'/');
        $params = explode('/',$url);
        $request->controller = $params[0];
        $request->action = isset($params[1]) ? $params[1] : 'index';
        $request->params = array_slice($params,2);
        echo "<pre>";print_r($request); echo "</pre>";
        return true;
    }
}
