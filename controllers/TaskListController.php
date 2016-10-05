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

        $title = filter_input(INPUT_POST, 'title');

        if (empty($title)) {
            $_SESSION['error_message'] = 'Title is required.';
        }

        if (!isset($_SESSION['error_message'])) {

            $data = array('title' => $title);

            $this->taskList->add($data);

            $_SESSION['alert_message'] = [
                'message' => "Task list {$title} <strong>successfully</strong> created!",
                'class' => 'alert-success',
            ];

            header("Location: /");
            exit();
        }

        header("Location: /list/add");
        exit();
    }

    public function edit($params)
    {
        $id = $params[0];
        $list = $this->taskList->findBy('id', $id);

        require_once 'views/edit.view.php';
    }

    public function update($params)
    {
        $id = $params[0];
        $title = filter_input(INPUT_POST, 'title');

        if (empty($title)) {
            $_SESSION['error_message'] = 'Title is required.';
        }

        if (!isset($_SESSION['error_message'])) {

            $data = array('title' => $title);

            $this->taskList->update($data, $id);

            $_SESSION['alert_message'] = [
                'message' => "Task list {$title} <strong>successfully</strong> edited!",
                'class' => 'alert-success',
            ];

            header("Location: /");
            exit();
        }

        header("Location: /list/{$id}/edit");
        exit();
    }

    public function delete($params)
    {
        $id = $params[0];

        $this->taskList->delete($id);
    }

}
