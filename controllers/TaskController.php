<?php

require_once 'models/Task.php';

class TaskController
{

    private $task;

    public function __construct()
    {
        $this->task = new Task();
    }

    public function add()
    {

        $description = filter_input(INPUT_POST, 'description');
        $list_id = filter_input(INPUT_POST, 'list_id');

        if (empty($description)) {
            $_SESSION['error_message'] = 'Description is required.';
        }

        if (!isset($_SESSION['error_message'])) {

            $data = array('description' => $description,
                'list_id' => $list_id);

            $id = $this->task->add($data);

            $json = array('id' => $id,
                'description' => $description,
                'list_id' => $list_id);

            echo json_encode($json);

            exit();
        }

        header("Location: /");
        exit();
    }

    public function toggle($params)
    {
        $id = $params[0];
        $completed = $params[1];

        $data = array('completed' => $completed);

        $this->task->update($data, $id);
    }

    public function delete($params)
    {
        $id = $params[0];

        $this->task->delete($id);
    }

    public function update($params)
    {
        $id = $params[0];
        $description = filter_input(INPUT_POST, 'description');

        if (empty($description)) {
            $_SESSION['error_message'] = 'Description is required.';
        }

        if (!isset($_SESSION['error_message'])) {

            $data = array('description' => $description);

            $this->task->update($data, $id);
        }

    }

}
