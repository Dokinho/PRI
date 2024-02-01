    <div class="row justify-content-center">
        <div class="col racnaslov">
            <div class="d-flex flex-wrap justify-content-center text-center">
                <div class="nar">
                    <p><img src="<?php echo base_url('assets/icons/order24.png');?>"><?php echo ' '.$racun_id;?></p>
                </div>
                <div class="nar">
                    <p><img src="<?php echo base_url('assets/icons/datey24.png');?>"><?php echo ' '.$datum;?></p>
                </div>
                <div class="nar">
                    <a href="#"><img src="<?php echo base_url('assets/icons/showy24.png');?>" onclick="prikaziNarudzbuToggle(<?php echo $racun_broj;?>)"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="racun-full" id="racfull<?php echo $racun_broj;?>">
        <div class="row justify-content-center text-center">
            <div class="col align-self-center racun">
                <p>Naziv</p>
            </div>
            <div class="col align-self-center racun">
                <p>Cijena</p>
            </div>
            <div class="col align-self-center racun">
                <p>Količina</p>
            </div>
            <div class="col align-self-center racun">
                <p>Iznos</p>
            </div>
        </div>
        <?php
            $ukupno = 0;
            foreach ($stavke as $i=>$stavka):
                $iznos = $stavka->cijena * $stavka->kolicina;
                $ukupno += $iznos;
        ?>
        <div class="row justify-content-center text-center">
            <div class="col align-self-center racun">
                <p><?php echo $stavka->naziv.' - '.$stavka->velicina?></p>
            </div>
            <div class="col align-self-center racun">
                <p><?php echo $stavka->cijena.' kn';?></p>
            </div>
            <div class="col align-self-center racun">
                <p><?php echo 'x'.$stavka->kolicina;?></p>
            </div>
            <div class="col align-self-center racun">
                <p><?php echo $iznos.' kn';?></p>
            </div>
        </div>
        <?php endforeach;?>
        <div class="row justify-content-center text-center">
            <div class="col align-self-center">
                <p class="font-weight-bold"><?php echo 'Ukupno: '.$ukupno.' kn'?></p>
            </div>
        </div>
        <br>
    </div>