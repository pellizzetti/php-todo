<?php

class Task
{
    public $description;
    protected $list_id = 1;
    public $completed = false;
    public $created_at;

    public function __construct($description, $created_at)
    {
        $this->description = $description;
        $this->created_at = $created_at;
    }

    public function isComplete()
    {
        return $this->completed;
    }

    public function complete()
    {
        $this->completed = true;
    }
}
