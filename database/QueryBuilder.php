<?php

class QueryBuilder
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $statament = $this->pdo->prepare("select * from {$table}");
        $statament->execute();

        return $statament->fetchAll(PDO::FETCH_OBJ);
    }

}
