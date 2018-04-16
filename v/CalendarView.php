<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 18-04-13
 * Time: 21:11
 */

namespace App\View;
require "/sys/kernel/Window.php";


class CalendarView extends Window
{
    public function __construct(string $id)
    {
        parent::__construct($id);

    }
}