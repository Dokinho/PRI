<div class="container-fluid text-yellow h-100">
    <div class="row justify-content-center text-center">
        <div class="col">
            <br><h1>Pizze</h1><br>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <!--Početak tablice-->
            <div class="table-responsive">
                <table class="table text-yellow text-center">
                    <thead>
                        <tr>
                            <th>Slika</th>
                            <th>Naziv</th>
                            <th>Opis</th>
                            <th>Cijena - mala</th>
                            <th>Cijena - srednja</th>
                            <th>Cijena - jumbo</th>
                            <th>Uredi</th>
                            <th>Ukloni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--Petlja-->
                        <?php foreach($pizze as $pizza):?>
                            <tr class="align-items-center align-self-center">
                                <td><img width="128" src="<?php echo base_url($pizza->slika);?>"></td>
                                <td class="align-middle"><?php echo $pizza->naziv;?></td>
                                <td class="align-middle"><?php echo $pizza->opis;?></td>
                                <td class="align-middle"><?php echo $pizza->cijena_m;?> kn</td>
                                <td class="align-middle"><?php echo $pizza->cijena_s;?> kn</td>
                                <td class="align-middle"><?php echo $pizza->cijena_j;?> kn</td>
                                <td class="align-middle">*Gumb*</td>
                                <td class="align-middle">*Gumb*</td>
                            </tr>
                        <?php endforeach;?>
                        <tr>
                            <td colspan="8"><a href="<?php echo site_url('admin/dodajpizzu');?>">Dodaj novu pizzu <img
                            src="<?php echo base_url('assets/icons/plus24.png');?>"></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>