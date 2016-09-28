<?php

require_once 'database/QueryBuilder.php';

class TaskList
{
    private $query;

    public $id;
    public $title;

    public function __construct()
    {
        $this->query = new QueryBuilder();
    }

    public function findAll()
    {
        return $this->query->select('lists', 'TaskList');
    }

    public function findTasks($id)
    {
        return $this->query->selectJoin('lists', 'tasks', 'id', 'list_id', $id, 'inner');
    }

    public function findBy($field, $value)
    {
        return $this->query->select('lists', 'TaskList', $field, $value);
    }

    public function add($data)
    {
        return $this->query->insert('lists', $data);
    }

    public function update($data, $id)
    {
        return $this->query->update('lists', $data, $id);
    }

    public function delete($id)
    {
        return $this->query->delete('lists', $id);
    }

}
