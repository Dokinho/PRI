<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/stil.css');?>">
    <title>NetPizza</title>
</head>
  <body>
    <header>
      <nav class="navbar navbar-expand navbar-light justify-content-between">
        <ul class="navbar-nav flex-row">
          <li class="nav-item">
            <a href="<?php echo site_url('home');?>"><img src="<?php echo base_url('assets/icons/home32.png');?>"></a>
          </li>
        </ul>
        <span class="navbar-brand mx-auto font-weight-bold"><h1>NetPizza</h1></span>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="<?php echo base_url('assets/icons/profile32.png');?>">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <h6 class="dropdown-header">Profil</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Prijava</a>
              <a class="dropdown-item" href="#">Registracija</a>
            </div>
          </li>
        </ul>
      </nav>
    </header>