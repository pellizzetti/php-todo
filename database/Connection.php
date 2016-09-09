<?php

class Connection
{
    public static function Make($config)
    {
        try {
            return new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die('Database connection failed.</br></br>Error: ' . $e->getMessage());
        }
    }
}
