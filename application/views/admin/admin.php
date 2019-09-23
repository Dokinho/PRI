<div class="container-fluid text-yellow h-100">
    <div class="row justify-content-center text-center">
        <div class="col">
            <br><h1>Administracijski alati</h1><br>
        </div>
    </div>
    <!--Korisnici-->
    <div class="row justify-content-center text-center">
        <div class="col">
            <h2>Korisnici</h2>
            <form action="<?php echo site_url('admin/korisnici');?>">
                <div class="form-group">
                    <button class="btn btn-yellow btn-admin font-weight-bold" type="submit">Pregled/izmjena korisnika</button>
                </div>
            </form>
            <form action="<?php echo site_url('admin/administratori');?>">
                <div class="form-group">
                    <button class="btn btn-yellow btn-admin font-weight-bold" disabled>Pregled administratora</button>
                </div>
            </form>
        </div>
    </div>
    <br>
    <!--Pizze-->
    <div class="row justify-content-center text-center">
        <div class="col">
            <h2>Pizze</h2>
            <form action="<?php echo site_url('admin/pizze');?>">
                <div class="form-group">
                    <button class="btn btn-yellow btn-admin font-weight-bold">Pregled/izmjena pizze</button>
                </div>
            </form>
            <form action="<?php echo site_url('admin/dodajpizzu');?>">
                <div class="form-group">
                    <button class="btn btn-yellow btn-admin font-weight-bold" disabled>Dodaj novu pizzu</button>
                </div>
            </form>
        </div>
    </div>
    <br>
     <!--Narudžbe-->
     <div class="row justify-content-center text-center">
        <div class="col">
            <h2>Narudžbe</h2>
            <form action="<?php echo site_url('admin/narudzbe');?>">
                <div class="form-group">
                    <button class="btn btn-yellow btn-admin font-weight-bold">Pregled narudžbi</button>
                </div>
            </form>
            <form>
                <div class="form-group">
                    <button class="btn btn-yellow btn-admin font-weight-bold" disabled>Zaprimljene narudžbe</button>
                </div>
            </form>
        </div>
    </div>
    <br>
</div>