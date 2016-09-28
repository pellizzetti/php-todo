<?php

require_once 'database/QueryBuilder.php';

class Task
{
    private $query;

    public $id;
    public $description;
    public $completed;
    public $created_at;

    public function __construct()
    {
        $this->query = new QueryBuilder();
    }

    public function isComplete()
    {
        return $this->completed;
    }

    public function add($data)
    {
        return $this->query->insert('tasks', $data);
    }

    public function update($data, $id)
    {
        return $this->query->update('tasks', $data, $id);
    }

    public function delete($id)
    {
        return $this->query->delete('tasks', $id);
    }

}
