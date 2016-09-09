<?php

return [
    'database' => [
        'connection' => 'mysql:host=127.0.0.1',
        'name' => 'phptodo',
        'username' => 'root',
        'password' => '',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
        ],
    ],
];
