<?php

return [
    '' => 'TaskListController@index',
    'add' => function () {
        require_once 'views/add.view.php';
    },
    'add/post' => 'TaskListController@add',
];
