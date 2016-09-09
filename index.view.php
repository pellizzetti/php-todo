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
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">PHP To-Do</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="container">

		<div class="starter">
		  <h1>Tasks list</h1>
		  <?php if (count($tasks)) : ?>
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
		  <?php else: ?>
			<p class="lead">The task list is empty<p>
		  <?php endif;?>
		</div>
	
	</div>

  </body>
</html>
