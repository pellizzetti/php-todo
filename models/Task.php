<?php

require 'database/QueryBuilder.php';

class Task
{
    private $query;

    public $description;
    public $completed = false;

    public function __construct()
    {
        $this->query = new QueryBuilder();
    }

    public function selectAll()
    {
        return $this->query->selectAll('tasks');
    }

    public function isComplete()
    {
        return $this->completed;
    }

    public function toggleComplete()
    {
        $this->completed = ! $this->completed;
    }
}
