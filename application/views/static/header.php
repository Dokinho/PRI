<?php
  //Tip korisnika 0 = "gost"
  if (!isset($_SESSION['logged_in'])) {
      $_SESSION['tip_korisnika'] = 0;
  }

  //Shopping cart
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/stil.css');?>">
    <title><?php echo $title?></title>
</head>
  <body>
  <!-- DEBUG -->
  <p class="text-yellow"><?php echo 'Tip korisnika: ', $_SESSION['tip_korisnika'];?>
  <a href="<?php echo site_url('testlogout');?>"> Odjava</a>|<?php if (isset($_SESSION['kos_broj'])) {
    echo '<a href="'.site_url('jelovnik/ukloni/'.$_SESSION['kos_broj']).'">Ukloni iz K</a></p>';}?>
    <!--DO TU-->
    <header>
    <!-- Navigacijska traka -->
      <nav class="navbar navbar-expand navbar-light justify-content-between">
        <ul class="navbar-nav flex-row">
        <!--Home-->
          <li class="nav-item d-none d-sm-inline">
            <a href="<?php echo site_url('home');?>"><img src="<?php echo base_url('assets/icons/home32.png');?>"></a>
          </li>
          <!--Jelovnik-->
          <li class="nav-item">
            <a href="<?php echo site_url('jelovnik');?>"><img src="<?php echo base_url('assets/icons/menu32.png');?>"></a>
          </li>
        </ul>
        <!--Naslov-->
        <span class="navbar-brand mx-auto font-weight-bold"><a id="nav-home" href="<?php echo site_url('home');?>">NetPizza</a></span>
        <ul class="navbar-nav flex-row-reverse">
        <!--Profil-->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="<?php echo base_url('assets/icons/profile32.png');?>">
            </a>
            <!--Profil dropdown menu-->
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <h6 class="dropdown-header">Profil</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Prijava</a>
              <a class="dropdown-item" href="#">Registracija</a>
            </div>
          </li>
          <!--Košarica-->
          <li class="nav-item dropdown d-none d-sm-inline">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="<?php echo base_url('assets/icons/cart32.png');?>">
            </a>
            <!--Košarica dropdown menu-->
            <div class="d-none d-sm-inline">
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <h6 class="dropdown-header">Košarica</h6>
              <div class="dropdown-divider"></div>
              <?php
                if (isset($_SESSION['kos_broj']) && $_SESSION['kos_broj'] > 0):
                $ukupno = 0.0;
                $indeks = 0;
                foreach ($_SESSION['kosarica'] as $stavka):
              ?>
              <div class="dropdown-item">
                <div class="d-inline kos-grupa">
                  <img class="kos-slika" width="64px" height="64px" src="<?php echo base_url($stavka['slika']);?>">
                  <span><?php echo $stavka['naziv'];?> - <?php echo $stavka['velicina'];?></span>
                </div>
                <div class="d-inline kos-grupa">
                  <a class="text-black" href="#">&minus;</a>
                  <span><?php echo $stavka['kolicina'];?></span>
                  <a class="text-black" href="#">+</a>
                </div>
                <div class="d-inline kos-grupa">
                  <span class="text-black" href="#"><?php echo $stavka['cijena'];?> kn</span>
                </div>
                <div class="d-inline kos-grupa">
                  <a class="text-black" href="<?php echo site_url('jelovnik/ukloni/'.$indeks.'/'.$page);?>"><img 
                  src="<?php echo base_url('assets/icons/bin16.png');?>"></a>
                </div>
              </div>
              <?php
                $ukupno += $stavka['cijena'] * $stavka['kolicina'];
                $indeks++;
                endforeach;
              ?>
              <div class="dropdown-divider"></div>
                <div class="dropdown-item">
                  <div class="d-flex kos-grupa">
                    <span class="mr-auto text-center font-weight-bold"><?php echo 'Ukupno: ', $ukupno, ' kn';?></span>
                    <a href="<?php echo site_url('kosarica');?>"><button class="btn btn-sm btn-primary font-weight-bold" id="naruci">Naruči</button></a>
                  </div>
                </div>
                <?php else:?>
                  <a class="dropdown-item" href="#">Vaša košarica je prazna!</a>
                <?php endif;?>
              </div>
            </div>
          </li>
          <!--Košarica za male ekrane-->
          <li class="nav-item d-inline d-sm-none">
            <a class="nav-link" href="<?php echo site_url('kosarica');?>"><img src="<?php echo base_url('assets/icons/cart32.png');?>"></a>
          </li>
        </ul>
      </nav>
    </header>