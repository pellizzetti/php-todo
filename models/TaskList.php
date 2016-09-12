<?php

require 'database/QueryBuilder.php';

class TaskList
{
    private $query;

    public $description;

    public function __construct()
    {
        $this->query = new QueryBuilder();
    }

    public function selectAll()
    {
        return $this->query->selectAll('lists');
    }

    public function selectTasks($id)
    {
        return $this->query->selectJoinAll('tasks', 'lists', 'list_id', 'id', $id);
    }

}
