<?php helper('form') ?>
    <div id="emailvar" style="display:none"><?php echo htmlspecialchars($_SESSION['email'])?></div>
    <div class="row justify-content-center text-center">
        <div class="col">
            <h1>Osobni podaci</h1>
        </div>
    </div>
    <div class="row justify-content-around text-center">
        <div class="col forma"><br>
                <form class="text-yellow" id="podaci" action="<?php echo site_url('profil/index/podaci');?>" method="post">
                    <!--Skrivena kontrolna polja-->
                    <input type="hidden" name="mail-change" id="mail-change" value>
                    <input type="hidden" name="pass-change" id="pass-change" value>
                    <fieldset disabled>
                        <div class="form-group">
                            <label class="form-text" for="ime">Ime</label>
                            <input type="text" class="form-control" name="ime" id="ime" value="<?php echo $_SESSION['ime'];?>">
                            <?php //echo form_error('ime');?>
                        </div>
                        <div class="form-group">
                            <label class="form-text" for="prezime">Prezime</label>
                            <input type="text" class="form-control" name="prezime" id="prezime" value="<?php echo $_SESSION['prezime'];?>">
                            <?php //echo form_error('prezime');?>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label class="form-text recenter" for="email">Email<a href="#"><img class="lil-edit" id="email-edit" onclick="promjeniEmail()"
                            src="<?php echo base_url('assets/icons/edit16.png');?>"></a><a href="#"><img class="lil-edit" id="email-unedit"
                            onclick="unPromjeniEmail()" src="<?php echo base_url('assets/icons/close16.png');?>"></a></label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Unesite novu e-mail adresu"
                            value="<?php echo $_SESSION['email'];?>" disabled>
                        <?php //echo form_error('email');?>
                    </div>
                    <div class="form-group" id="mail-conf-group">
                        <label class="form-text" for="mailconf">Potvrdite Email</label>
                        <input type="email" class="form-control" name="mailconf" id="mailconf" placeholder="Potvrdite novu e-mail adresu"
                            value="<?php echo set_value('mailconf');?>">
                        <?php //echo form_error('mailconf');?>
                    </div>
                    <div class="form-group" id="old-lozinka-group">
                        <label class="form-text recenter" for="oldlozinka">Stara lozinka<a href="#"><img class="lil-edit" id="pass-unedit"
                            onclick="unPromjeniLozinku()" src="<?php echo base_url('assets/icons/close16.png');?>"></a></label>
                        <input type="password" class="form-control" name="oldlozinka" id="oldlozinka" placeholder="Unesite staru lozinku">
                        <?php //echo form_error('oldlozinka');?>
                    </div>
                    <div class="form-group" id="lozinka-group">
                        <label class="form-text recenter" for="lozinka">Lozinka<a href="#"><img class="lil-edit" id="pass-edit" onclick="promjeniLozinku()"
                            src="<?php echo base_url('assets/icons/edit16.png');?>"></a></label>
                        <input type="password" class="form-control" name="lozinka" id="lozinka" placeholder="Unesite novu lozinku" value="**********" disabled>
                        <?php //echo form_error('lozinka');?>
                    </div>
                    <div class="form-group" id="pass-conf-group">
                        <label class="form-text" for="passconf">Potvrdite lozinku</label>
                        <input type="password" class="form-control" name="passconf" id="passconf" placeholder="Potvrdite novu lozinku">
                        <?php //echo form_error('passconf');?>
                    </div>
                    <div class="form-group" id="promjeni">
                        <button class="btn btn-yellow font-weight-bold" type="submit">Spremi promjene</button>
                    </div>
                </form>
                <form action="<?php echo site_url('profil/ukloniracun');?>" method="post">
                <input type="hidden" name="protecc" id="protecc" value>
                    <div class="form-group">
                        <button class="btn btn-danger font-weight-bold" type="submit" onmouseover="brisanjeDozvoljeno()">Obriši račun</button>
                    </div>
                </form>
                <?php if ($mail_change) echo '<script>promjeniEmail();</script>';?>
                <?php if ($pass_change) echo '<script>promjeniLozinku();</script>';?>