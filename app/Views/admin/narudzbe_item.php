<div class="row justify-content-center text-center">
    <div class="d-flex flex-wrap justify-content-center text-center">
        <div class="nar">
            <p><img src="<?php echo base_url('assets/icons/order24.png');?>"><?php echo ' '.$racun_id;?></p>
        </div>
        <div class="nar">
            <p><img src="<?php echo base_url('assets/icons/datey24.png');?>"><?php echo ' '.$datum;?></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <!--Početak tablice-->
        <table class="table text-yellow text-center">
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Cijena</th>
                    <th>Količina</th>
                    <th>Iznos</th>
                </tr>
            </thead>
            <tbody>
                <!--Petlja-->
                <?php
                    $ukupno = 0;
                    foreach ($stavke as $stavka):
                        $iznos = $stavka->cijena * $stavka->kolicina;
                        $ukupno += $iznos;
                ?>
                    <tr>
                        <td><?php echo $stavka->naziv.' - '.$stavka->velicina;?></td>
                        <td><?php echo $stavka->cijena.' kn';?></td>
                        <td><?php echo 'x'.$stavka->kolicina;?></td>
                        <td><?php echo $iznos.' kn';?></td>
                    </tr>
                <?php endforeach;?>
                <tr>
                    <td class="font-weight-bold text-right" colspan="3">Ukupno:</td>
                    <td class="font-weight-bold"><?php echo $ukupno.' kn'?></td>
                </tr>
            </tbody>
        </table>
        <br>
    </div>
</div>