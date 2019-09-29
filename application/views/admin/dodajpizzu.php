<div class="container-fluid text-yellow h-100">
    <div class="row justify-content-center text-center" id="reg">
        <div class="col forma">
            <br><h1>Nova pizza</h1><br>
            <form action="<?php echo site_url('admin/dodajpizzu');?>" method="post">
                <div class="form-group">
                    <label class="form-text font-weight-bold" for="slika">Slika</label>
                    <input type="file" name="slika" id="slika" value="<?php echo set_value('slika');?>">
                    <?php echo form_error('slika');?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="naziv">Naziv</label>
                    <input type="text" class="form-control" name="naziv" id="naziv" placeholder="Naziv pizze" value="">
                    <?php echo form_error('naziv');?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="opis">Opis</label>
                    <input type="text" class="form-control" name="opis" id="opis" placeholder="Sastojci pizze, komentar" value="">
                    <?php echo form_error('opis');?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="cijena_m">Cijena (mala)</label>
                    <input type="number" class="form-control" name="cijena_m" id="cijena_m" placeholder="Cijena male pizze" value="">
                    <?php echo form_error('cijena_m');?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="cijena_s">Cijena (srednja)</label>
                    <input type="number" class="form-control" name="cijena_s" id="cijena_s" placeholder="Cijena srednje pizze" value="">
                    <?php echo form_error('cijena_s');?>
                </div>
                <div class="form-group">
                    <label class="form-text" for="cijena_j">Cijena (jumbo)</label>
                    <input type="number" class="form-control" name="cijena_j" id="cijena_j" placeholder="Cijena jumbo pizze" value="">
                    <?php echo form_error('cijena_j');?>
                </div>
                <div class="form-group">
                    <button class="btn btn-yellow font-weight-bold" type="submit">Dodaj</button>
                </div>
            </form>
        </div>
    </div>
</div>