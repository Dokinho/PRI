        <p class="text-yellow font-weight-bold">Promjena podataka uspješna!</p>
        <div class="row justify-content-center">
            <div class="col">
                <p class="recenter">Dodaj novu adresu<a href="#"><img class="lil-edit" id= "adr-add" src="<?php echo base_url('assets/icons/plus16.png');?>"
                    onclick="novaAdresa()"></a><a href="#"><img class="lil-edit" id="adr-unadd" src="<?php echo base_url('assets/icons/closey16.png');?>"
                    onclick="unNovaAdresa()"></a></p>
            </div>
        </div>
        <div class="row adresafull" id="adr-new">
            <div class="col forma mx-auto">
                <form class="text-yellow" action="<?php echo site_url('profil/dodajadr/'.$max_index);?>" method="post">
                    <div class="form-group">
                        <label class="form-text" for="newkratica">Naziv/Kratica</label>
                        <input type="text" class="form-control" name="newkratica" id="newkratica" placeholder="<?php echo 'Adresa '.$max_index;?>">
                    </div>
                    <div class="form-group">
                        <label class="form-text" for="newime">Ime</label>
                        <input type="text" class="form-control" name="newime" id="newime" value="<?php echo $_SESSION['ime'];?>">
                        <?php //echo form_error('newime');?>
                    </div>
                    <div class="form-group">
                        <label class="form-text" for="prezime">Prezime</label>
                        <input type="text" class="form-control" name="newprezime" id="newprezime" value="<?php echo $_SESSION['prezime'];?>">
                        <?php //echo form_error('newprezime');?>
                    </div>
                    <div class="form-group">
                        <label class="form-text" for="newtelefon">Telefon/Mobitel</label>
                        <input type="text" class="form-control" name="newtelefon" id="newtelefon" value="<?php echo $_SESSION['telefon'];?>">
                        <?php //echo form_error('newtelefon');?>
                    </div>
                    <div class="form-group">
                        <label class="form-text" for="newulica">Ulica</label>
                        <input type="text" class="form-control" name="newulica" id="newulica" placeholder="Unesite ulicu">
                        <?php //echo form_error('newulica');?>
                    </div>
                    <div class="form-group">
                        <label class="form-text" for="newkucni_broj">Kućni broj</label>
                        <input type="text" class="form-control" name="newkucni_broj" id="newkucni_broj" placeholder="Kućni broj">
                        <?php //echo form_error('newkucni_broj');?>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-yellow font-weight-bold" type="submit">Dodaj adresu</button>
                    </div>
                </form>
                <?php if ($dodajeli) echo '<script>novaAdresa();</script>';?>
                <?php if ($adr_change > -1) echo '<script>promjeniAdresu('.$adr_change.');</script>';?>
            </div>
        </div>
    </div>
</div>