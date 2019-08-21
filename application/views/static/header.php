<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/stil.css');?>">
    <title>Online Pizzeria</title>
</head>
  <body>
    <header>
      <div class="jumbotron text-center">
        <h1 class="display-4">Online Pizzeria</h1>
      </div>
      <nav class="navbar navbar-dark bg-dark">
        <ul class="navbar-nav">
          <li class="nav-item">
            <?php echo anchor('home', 'Home', 'class="nav-link"');?>
          </li>
          <li class="nav-item">
            <?php echo anchor('login', 'Login', 'class="nav-link"');?>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="#"><img src="<?php echo base_url('assets/icons/profile64.png')?>"></a>
          </li>
        </ul>
      </nav>
    </header>