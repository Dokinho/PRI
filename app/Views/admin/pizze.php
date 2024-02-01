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
            <form class="form" action="<?php echo site_url('admin/promjenipizze');?>" method="post">
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
                            <input id="<?php echo 'pcf'.$pizza->id;?>" type="hidden" name="<?php echo 'pizza-edit['.$pizza->id.']';?>" value="<?php echo $pizza->id;?>" disabled>
                            <tr class="align-items-center align-self-center" id="<?php echo 'tr'.$pizza->id;?>">
                                <td>
                                    <img width="128" src="<?php echo base_url($pizza->slika);?>">
                                </td>
                                <td class="align-middle">
                                    <input class="ap" type="text" name="<?php echo 'naziv['.$pizza->id.']';?>" value="<?php echo $pizza->naziv;?>" disabled>
                                </td>
                                <td class="align-middle">
                                    <textarea class="ap" cols="25" rows="3" name="<?php echo 'opis['.$pizza->id.']';?>" disabled><?php echo $pizza->opis;?></textarea>
                                </td>
                                <td class="align-middle">
                                    <input class="ap" type="text" name="<?php echo 'cijena_m['.$pizza->id.']';?>" value="<?php echo $pizza->cijena_m;?>" size="4" disabled> kn
                                </td>
                                <td class="align-middle">
                                    <input class="ap" type="text" name="<?php echo 'cijena_s['.$pizza->id.']';?>" value="<?php echo $pizza->cijena_s;?>" size="4" disabled> kn
                                </td>
                                <td class="align-middle">
                                    <input class="ap" type="text" name="<?php echo 'cijena_j['.$pizza->id.']';?>" value="<?php echo $pizza->cijena_j;?>" size="4" disabled> kn
                                </td>
                                <td class="align-middle">
                                    <a id="<?php echo 'pe'.$pizza->id;?>" href="#"><img src="<?php echo base_url('assets/icons/edity16.png');?>"
                                        onclick="<?php echo 'urediPizzu('.$pizza->id.')';?>"></a>
                                    <a class="pizedit" id="<?php echo 'pue'.$pizza->id;?>" href="#"><img src="<?php echo base_url('assets/icons/closey16.png');?>"
                                        onclick="<?php echo 'unUrediPizzu('.$pizza->id.')';?>"></a>
                                </td>
                                <td class="align-middle">
                                    <a href="<?php echo site_url('admin/uklonipizzu/'.$pizza->id);?>"><img src="<?php echo base_url('assets/icons/bin16.png');?>"></a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        <tr>
                            <td colspan="8"><button class="btn btn-yellow font-weight-bold" id="promjeni" type="submit" style="margin:1rem">Spremi promjene</button></td>
                        </tr>
                        <tr>
                            <td colspan="8"><a href="<?php echo site_url('admin/dodajpizzu');?>">Dodaj novu pizzu <img
                            src="<?php echo base_url('assets/icons/plus24.png');?>"></a></td>
                        </tr>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
</div>