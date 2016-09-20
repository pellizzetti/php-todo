<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PHP To-Do</title>

    <link href="views/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="views/assets/css/style.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">

        <div class="navbar-header">
          <a class="navbar-brand" href="#">PHP To-Do</a>
        </div>

        <div class="collapse navbar-collapse" id="menu-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

  <div class="container">

    <div class="starter">

      <a href="list/add" class="pull-right btn btn-default" role="button"><span class="glyphicon glyphicon-plus"></span> Add Task List</a>
      </br>

      <hr>

      <h1>Task Lists</h1>

      <?php if (count($lists)): ?>

        <div class="panel list-group">

          <?php foreach ($lists as $list): ?>

            <span class="list-group-item" data-toggle="collapse" <?="data-target=\"#list-{$list->id}\"";?>><a <?="href=\"list/{$list->id}/delete\"";?>><span class="glyphicon glyphicon-remove"></span></a>
              <strong><?=$list->title;?></strong>
              <?php if (count($list->tasks)): ?>

                <span class="pull-right badge badge-primary"><?=count($list->tasks)?></span></span>

                <div <?="id=\"list-{$list->id}\"";?> class="sublinks collapse">
                  <?php foreach ($list->tasks as $task): ?>
                    <a class="list-group-item small">

                      <?php if ($task->completed): ?>
                        <?="<strike>{$task->description}</strike>";?>
                      <?php else: ?>
                        <?="{$task->description}";?>
                      <?php endif;?>
                      <div class="pull-right">
                        <span class="glyphicon glyphicon-edit"></span>
                        <span class="glyphicon glyphicon-remove"></span>
                      </div>
                    </a>
                  <?php endforeach;?>
                </div>

              <?php else: ?>
                </span>
                <div <?="id=\"list-{$list->id}\"";?> class="sublinks collapse">
                  <a class="list-group-item small">No tasks here :(</a>
                </div>
              <?php endif;?>

          <?php endforeach;?>

        </div>


      <?php else: ?>
        <?="<h4>No task lists created</h4>"?>
      <?php endif;?>

    </div>

  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
  <script src="views/assets/js/bootstrap.min.js"></script>
  </body>
</html>
