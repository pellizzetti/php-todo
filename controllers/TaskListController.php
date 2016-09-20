<?php

require_once 'models/TaskList.php';

class TaskListController
{

    private $taskList;

    public function __construct()
    {
        $this->taskList = new TaskList();
    }

    public function index()
    {
        $lists = $this->taskList->findAll();
        foreach ($lists as $list) {
            $list->tasks = $this->taskList->findTasks($list->id);
        }

        require_once 'views/index.view.php';
    }

    public function add()
    {

        $title = $_POST['title'];

        if (empty($title)) {
            $error['title'] = 'Title is required.';
        }

        if (!isset($error)) {

            $data = array('title' => $title);

            $this->taskList->add($data);

            header("Location: /");
            exit();
        }

        header("Location: /list/add");
        exit();
    }

    public function delete($data)
    {
        $id = $data[0];
        $this->taskList->delete($id);

        header("Location: /");
        exit();
    }

}
