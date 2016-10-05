<?php

return [
    '/' => 'TaskListController@index',
    '/list/add' => function () {
        require_once 'views/add.view.php';
    },
    '/list/add/post' => 'TaskListController@add',
    '/list/:id/edit' => 'TaskListController@edit',
    '/list/:id/edit/update' => 'TaskListController@update',
    '/list/:id/delete' => 'TaskListController@delete',
    '/task/add/post' => 'TaskController@add',
    '/task/:id/toggle/:status' => 'TaskController@toggle',
    '/task/:id/delete' => 'TaskController@delete',
    '/task/:id/edit/update' => 'TaskController@update',
];
