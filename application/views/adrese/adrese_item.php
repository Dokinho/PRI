        <div class="row justify-content-center">
            <div class="col adrnaslov">
                <h3 class="d-inline recenter"><img  class="adr" src="<?php echo base_url('assets/icons/address24.png');?>"><?php echo $kratica?><a href="#"><img class="lil-edit"
                    id="<?php echo 'adr-edit-'.$i?>" src="<?php echo base_url('assets/icons/edity16.png');?>"
                    onclick="<?php echo 'promjeniAdresu('.$i.')'?>"></a><a href="#"><img class="lil-edit unedit"
                    id="<?php echo 'adr-unedit-'.$i?>" src="<?php echo base_url('assets/icons/closey16.png');?>"
                    onclick="<?php echo 'unPromjeniAdresu('.$i.')'?>"></a><a href="<?php echo site_url('profil/ukloniadr/'.$id);?>"><img class="lil-edit"
                    id="<?php echo 'adr-remove-'.$i?>" src="<?php echo base_url('assets/icons/bin16.png');?>"></a></h3>
            </div>
        </div>
        <div class="row adresafull" id="<?php echo 'adr'.$i?>">
        <div class="col forma mx-auto">
            <form class="text-yellow" action="<?php echo site_url('profil/index/adrese/'.$i.'/'.$id);?>" method="post">
            <input type="hidden" name="<?php echo 'adr-change'.$i;?>" id="<?php echo 'adr-change-'.$i;?>" value>
                <div class="form-group">
                    <label class="form-text" for="<?php echo 'kratica'.$i?>">Naziv/Kratica</label>
                    <input type="text" class="form-control" name="<?php echo 'kratica'.$i;?>" id="<?php echo 'kratica'.$i?>" value="<?php echo $kratica?>">
                </div>
                <div class="form-group">
                    <label class="form-text" for="<?php echo 'ime'.$i?>">Ime</label>
                    <input type="text" class="form-control" name="<?php echo 'ime'.$i;?>" id="<?php echo 'ime'.$i?>" value="<?php echo $ime;?>">
                    <?php echo form_error('ime'.$i);?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="<?php echo 'prezime'.$i?>">Prezime</label>
                    <input type="text" class="form-control" name="<?php echo 'prezime'.$i;?>" id="<?php echo 'prezime'.$i?>" value="<?php echo $prezime;?>">
                    <?php echo form_error('prezime'.$i);?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="<?php echo 'telefon'.$i?>">Telefon/Mobitel</label>
                    <input type="text" class="form-control" name="<?php echo 'telefon'.$i;?>" id="<?php echo 'telefon'.$i?>" value="<?php echo $telefon;?>">
                    <?php echo form_error('telefon'.$i);?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="<?php echo 'ulica'.$i?>">Ulica</label>
                    <input type="text" class="form-control" name="<?php echo 'ulica'.$i;?>" id="<?php echo 'ulica'.$i?>" value="<?php echo $ulica;?>">
                    <?php echo form_error('ulica'.$i);?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="<?php echo 'kucni_broj'.$i?>">Kućni broj</label>
                    <input type="text" class="form-control" name="<?php echo 'kucni_broj'.$i;?>" id="<?php echo 'kucni_broj'.$i?>" value="<?php echo $kucni_broj;?>">
                    <?php echo form_error('kucni_broj'.$i);?>
                </div>
                <div class="form-group">
                    <button class="btn btn-yellow font-weight-bold" type="submit">Spremi promjene</button>
                </div>
            </form>
        </div>
    </div>
