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

  <div class="modal fade" id="delete-confirmation" tabindex="-1" role="dialog" aria-labelledby="modalDeleteConfirmation" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">x</button>
          <h4 class="modal-title" id="modalDeleteConfirmation">Confirm Delete</h4>
        </div>

        <div class="modal-body">
          <p>You are about to delete <b><i class="title"></i></b>.</p>
          <p>Do you want to proceed?</p>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger btn-ok">Delete</a>
        </div>
      </div>
    </div>
  </div>

    <div class="starter">
      <?php if (isset($_SESSION['alert_message'])): ?>
        <div <?="class=\"alert {$_SESSION['alert_message']['class']}\"";?>>
          <button type="button" class="close" data-dismiss="alert">x</button>
          <?=$_SESSION['alert_message']['message'];?>
        </div>
      <?php endif;?>

      <a href="list/add" class="pull-right btn btn-default" role="button"><span class="glyphicon glyphicon-plus"></span> Add Task List</a>
      </br>

      <hr>

      <h1>Task Lists</h1>

      <?php if (count($lists)): ?>

      <?php foreach ($lists as $list): ?>
      <div class="panel panel-default" <?="id=\"list-{$list->id}\"";?>>

        <div class="panel-heading">
          <div class="row">

          <div class="col-lg-6">
            <div class="pull-left action-buttons">
              <div class="btn-group pull-right">
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-cog"></span>
                </button>
                <ul class="dropdown-menu slidedown">
                  <li class="text-center">Task List</li>
                  <li><a <?="href=\"list/{$list->id}/edit\"";?>><span class="text-info glyphicon glyphicon-pencil"></span>Edit</a></li>
                  <li><a href="#" <?="data-id=\"{$list->id}\" data-title=\"{$list->title}\"";?> data-origin="list" data-toggle="modal" data-target="#delete-confirmation"><span class="text-danger glyphicon glyphicon-trash"></span>Delete</a></li>
                </ul>
              </div>
            </div>
            <div class="panel-title" data-toggle="collapse" <?="data-target=\"#list-tasks-{$list->id}\"";?>>
              <strong><?=$list->title;?></strong>
              <?php if (count($list->tasks)): ?>
              <span class="badge progress-bar-info"><?=count($list->tasks)?></span>
              <?php endif;?>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" placeholder="Task description...">
              <span class="input-group-btn">
                <button class="add-task btn btn-primary" <?="data-id=\"{$list->id}\"";?> type="button">Add Task</button>
              </span>
            </div>
          </div>

          </div> <!-- /.row-->
        </div> <!-- /.panel-heading -->

        <div <?php echo ($list == $lists{0} ? "class=\"panel-body sublinks collapse in\"" : "class=\"panel-body sublinks collapse\""); ?>  <?="id=\"list-tasks-{$list->id}\"";?>>
          <ul class="list-group">
            <?php foreach ($list->tasks as $task): ?>
            <li class="list-group-item" <?="id=\"task-{$task->id}\" data-id=\"{$task->id}\"";?>>
              <div class="checkbox">
                <input type="checkbox" class="completed" <?="id=\"checkbox-{$task->id}\"";?> <?php if ($task->completed): echo 'checked';endif;?>>
                <p><?=$task->description;?></p>
              </div>
              <div class="pull-right action-buttons">
                <a class="edit-task" href="#" <?="data-id=\"{$task->id}\"";?>><span class="text-info glyphicon glyphicon-pencil"></span></a>
                <a class="delete-task" href="#" <?="data-id=\"{$task->id}\" data-title=\"{$task->description}\"";?> data-origin="task" data-toggle="modal" data-target="#delete-confirmation"><span class="text-danger glyphicon glyphicon-trash"></span></a>
              </div>
            </li>
            <?php endforeach;?>
          </ul> <!-- /.list-group -->
        </div> <!-- /.panel-body -->

      </div> <!-- /.panel -->

      <?php endforeach;?>

      <?php else: ?>
        <?="<h4>No task lists created</h4>"?>
      <?php endif;?>

    </div>
    <?php unset($_SESSION['alert_message']);?>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
  <script src="views/assets/js/bootstrap.min.js"></script>
  <script src="views/assets/js/app.js"></script>
  </body>
</html>
