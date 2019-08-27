<?php if (isset($_SESSION['kos_broj']) && $_SESSION['kos_broj'] > 0):?>
<div class="container-fluid text-yellow">
  <div class="row justify-content-center text-center">
    <div class="col">
      <br><h1>Košarica</h1><br>
    <form action="" method="post">
      <?php
        $ukupno = 0.0;
        $indeks = 0;
        foreach ($_SESSION['kosarica'] as $stavka):
      ?>
      <div class="row align-items-center">
        <div class="col-3">
          <img class="img-fluid kos-slika-big" src="<?php echo base_url($stavka['slika']);?>">
        </div>
        <div class="col-3">
          <p><?php echo $stavka['naziv'];?> - <?php echo $stavka['velicina'];?></p>
        </div>
        <div class="col-2 d-none d-md-inline">
          <p><?php echo $stavka['opis'];?></p>
        </div>
        <div class="col-2">
          <button class="d-inline btn btn-sm btn-min font-weight-bold">&minus;</button>
          <p class="d-inline"><?php echo $stavka['kolicina'];?></p>
          <button class="d-inline btn btn-sm btn-plus font-weight-bold">+</button>
        </div>
        <div class="col-1">
          <p><?php echo $stavka['cijena'];?> kn</p>
        </div>
        <div class="col-1">
          <a href="<?php echo site_url('kosarica/ukloni/'.$indeks);?>"><img src="<?php echo base_url('assets/icons/bin16.png');?>"></a>
        </div>
      </div>
      <?php
        $ukupno += $stavka['cijena'] * $stavka['kolicina'];
        $indeks++;
        endforeach;?>
      <br>
      <div class="row justify-content-center">
        <div class="col align-items-center">
          <h1>Ukupno: <?php echo $ukupno;?> kn</h1>
          <br>
          <button class="btn font-weight-bold" id="naruci-big">Naruči</button>
        </div>
      </div>
    </form>
      <?php else:?>
        <div class="container-fluid text-wrap text-yellow" id="bghome">
          <div class="row justify-content-center text-center">
            <div class="col">
              <br>
              <h1>Košarica</h1>
              <br>
            </div>
          </div>
          <div class="row justify-content-start align-items-center h-50">
            <div class="col-8" style="padding-left: 10%">
              <div id="welcome-text">
                <p>Vaša košarica je prazna! Napunite ju <a href="<?php echo site_url('jelovnik');?>"> ovdje</a>.</p>
              </div>
      <?php endif;?>
    </div>
  </div>
</div>

<!-- Slika, naziv - veličina, opis, količina, cijena-->