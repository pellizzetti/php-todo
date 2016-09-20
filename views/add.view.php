<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PHP To-Do</title>

    <link href="../../views/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../views/assets/css/style.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">

        <div class="navbar-header">
          <a class="navbar-brand" href="/">PHP To-Do</a>
        </div>

        <div class="collapse navbar-collapse" id="menu-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

	<div class="container">

		<div class="starter">

			<h1>Add a Task List</h1>
			<form action="add/post" method="POST">
        <?php if (!isset($error)): ?>
				  <?='<div class="form-group">';?>
        <?php else: ?>
          <?='<div class="form-group has-error">';?>
        <?php endif;?>
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Title">
          <?php if (!isset($error)): ?>
            <?='<span id="helpBlock" class="help-block"></span>';?>
          <?php endif;?>
				</div>
				<button type="submit" class="pull-right btn btn-default">Submit</button>
			</form>

		</div>

	</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
  <script src="../../views/assets/js/bootstrap.min.js"></script>
  </body>
</html>
