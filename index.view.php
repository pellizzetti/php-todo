<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PHP To-Do</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand">PHP To-Do</a>
        </div>
      </div>
    </nav>

    <div class="container">

      <div class="starter">
        <h1>Tasks list</h1>
        <ul class="list-group">
          <?php foreach ($tasks as $task): ?>
            <li class="list-group-item">
              <?php if ($task->completed): ?>
                <?="<strike>{$task->description}</strike>";?>
              <?php else: ?>
                <?=$task->description;?>
              <?php endif;?>
            </li>
          <?php endforeach;?>
        </ul>
      </div>

    </div>

  </body>
</html>