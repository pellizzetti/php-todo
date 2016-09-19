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

    public function selectAll($table, $class)
    {
        $stmt = $this->pdo->prepare("select * from {$table}");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, $class);
    }

    public function selectJoinAll($table, $joinTable, $fk, $pk, $id, $join = '')
    {
        $stmt = $this->pdo->prepare("select * from {$table} t1 {$join} join {$joinTable} t2 on (t1.{$fk} = t2.{$pk} and t2.{$pk} = {$id})");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert($table, $data)
    {
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $stmt = $this->pdo->prepare("insert into {$table} ({$fields}) values ({$values})");

        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        $stmt->execute();
    }

}
