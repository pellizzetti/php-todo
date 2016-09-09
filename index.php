<?php

require 'models/Task.php';

$database = require 'bootstrap.php';

$tasks = $database->selectAll('tasks', 'Task');

require 'index.view.php';
