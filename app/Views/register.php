<?php helper('form') ?>
<div class="container-fluid text-yellow" id="bghome">
    <div class="row justify-content-center text-center" id="reg">
        <div class="col forma">
            <br><h1>Registracija</h1><br>
            <form action="<?php echo site_url('register');?>" method="post">
                <div class="form-group">
                    <label class="form-text" for="ime">Ime</label>
                    <input type="text" class="form-control" name="ime" id="ime" placeholder="Unesite vaše ime" value="<?php echo set_value('ime');?>">
                    <?php //echo form_error('ime');?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="prezime">Prezime</label>
                    <input type="text" class="form-control" name="prezime" id="prezime" placeholder="Unesite vaše prezime" value="<?php echo set_value('prezime');?>">
                    <?php //echo form_error('prezime');?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="telefon">Mobitel/Telefon</label>
                    <input type="text" class="form-control" name="telefon" id="telefon" placeholder="Unesite broj mobitela/telefona" value="<?php echo set_value('telefon');?>">
                    <?php //echo form_error('telefon');?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Unesite vašu e-mail adresu" value="<?php echo set_value('email');?>">
                    <?php //echo form_error('email');?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="mailconf">Potvrdite Email</label>
                    <input type="email" class="form-control" name="mailconf" id="mailconf" placeholder="Potvrdite vašu e-mail adresu" value="<?php echo set_value('mailconf');?>">
                    <?php //echo form_error('mailconf');?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="lozinka">Lozinka</label>
                    <input type="password" class="form-control" name="lozinka" id="lozinka" placeholder="Unesite vašu lozinku" value="<?php echo set_value('lozinka');?>">
                    <?php //echo form_error('lozinka');?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="passconf">Potvrdite lozinku</label>
                    <input type="password" class="form-control" name="passconf" id="passconf" placeholder="Potvrdite vašu lozinku" value="<?php echo set_value('passconf');?>">
                    <?php //echo form_error('passconf');?>
                </div><br>
                <div class="form-group">
                    <button class="btn btn-yellow font-weight-bold" type="submit">Registriraj se</button>
                </div>
            </form>
        </div>
    </div>
</div>