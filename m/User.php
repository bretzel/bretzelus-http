<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 18-04-17
 * Time: 11:48
 */

namespace App\Data;


class User
{
    var $name;
    var $alias;
    var $passwd;
    var $start;
    var $end;
    var $avatar_img;
    var $birth;
    var $level;
    var $points;

    public function __construct()
    {

    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}

