<?php

require_once 'database/QueryBuilder.php';

class TaskList
{
    private $query;

    public $id;
    public $description;
    public $tasks;

    public function __construct()
    {
        $this->query = new QueryBuilder();
    }

    public function findAll()
    {
        return $this->query->selectAll('lists', 'TaskList');
    }

    public function findTasks($id)
    {
        return $this->query->selectJoinAll('tasks', 'lists', 'list_id', 'id', $id);
    }

    public function add($data)
    {
        return $this->query->insert('lists', $data);
    }

    public function delete($id)
    {
        return $this->query->delete('lists', $id);
    }

}
