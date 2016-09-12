<?php

require 'models/TaskList.php';

class HomeController
{

    public static function index()
    {

        $taskList = new TaskList();
        $lists = $taskList->selectAll();

        require 'views/index.view.php';
    }

}
