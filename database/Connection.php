<?php

class Connection
{

    public static function Make($config = '/config/app.php')
    {
        $config = require $config;

        try {
            return new PDO(
                $config['database']['connection'] . 
                ';dbname=' . $config['database']['name'],
                $config['database']['username'],
                $config['database']['password'],
                $config['database']['options']
            );
        } catch (PDOException $e) {
            die('Database connection failed.</br></br>Error: ' . $e->getMessage());
        }
    }

}
