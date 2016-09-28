<?php

require_once 'Connection.php';

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

    public function select($table, $class, $whereField = null, $whereValue = null)
    {
        $query = "select * from {$table}";

        if (($whereField !== null) && ($whereValue !== null)) {
            $query .= " where {$whereField} = {$whereValue}";
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        if ($whereField !== null) {
            return $stmt->fetchObject($class);
        }
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectJoin($table, $joinTable, $fk, $pk, $id, $join = '')
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

        return $this->pdo->lastInsertId();
    }

    public function update($table, $data, $id)
    {
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $stmt = $this->pdo->prepare("update {$table} set {$fields} = {$values} where id = :id");

        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete($table, $id)
    {
        $stmt = $this->pdo->prepare("delete from {$table} where id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

}
