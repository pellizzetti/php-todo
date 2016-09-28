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

			<h1>Edit <?=$list->title;?></h1>
			<form action="edit/update" method="POST">
        <?php if (!isset($_SESSION['error_message'])): ?>
				  <?='<div class="form-group">';?>
        <?php else: ?>
          <?='<div class="form-group has-error">';?>
        <?php endif;?>
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Title" <?="value=\"{$list->title}\"";?>>
          <?php if (isset($_SESSION['error_message'])): ?>
            <?="<span id=\"helpBlock\" class=\"help-block\">{$_SESSION['error_message']}</span>";?>
          <?php endif;?>
				</div>
				<button type="submit" class="pull-right btn btn-default">Submit</button>
			</form>

		</div>
    <?php unset($_SESSION['error_message']);?>
	</div>
  </body>
</html>
