<?php

return [
    '' => 'TaskListController@index',
    'list/add' => function () {
        require_once 'views/add.view.php';
    },
    'list/add/post' => 'TaskListController@add',
    'list/:id/edit' => 'TaskListController@edit',
    'list/:id/delete' => 'TaskListController@delete',
];
