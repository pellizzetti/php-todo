<?php

require 'Connection.php';

class QueryBuilder
{

    private $pdo = null;

    public function __construct()
    {
        try {
            $this->pdo = Connection::Make();
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function selectAll($table)
    {
        $stmt = $this->pdo->prepare("select * from {$table}");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectJoinAll($table, $joinTable, $fk, $pk, $id, $join = "inner")
    {
        $stmt = $this->pdo->prepare("select * from {$table} t1 {$join} join {$joinTable} t2 on (t1.{$fk} = t2.{$pk} and t2.{$pk} = {$id})");
        //var_dump($stmt);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}