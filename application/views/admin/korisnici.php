<div class="container-fluid text-yellow h-100">
    <div class="row justify-content-center text-center">
        <div class="col">
            <br><h1>Korisnici</h1><br>
        </div>
    </div>
    <!--Tražilica-->
        <div class="d-flex flex-wrap align-items-center justify-content-center">
        <h2>Tražilica:</h2>
            <form class="form" action="<?php echo site_url('admin/trazikorisnika/');?>" method="post">
                <div class="form-group adr-item">
                    <input type="text" id="filter" name="filter">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="ime" value="ime" name="pocemu" checked>
                        <label class="my-auto" for="ime">Po imenu/prezimenu</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="mail" value="mail" name="pocemu">
                        <label class="my-auto" for="mail">Po e-mailu</label>
                    </div>
                    <button class="btn btn-yellow font-weight-bold" type="submit">Traži</button>
                </div>
                <div class="form-group">
                </div>
            </form>
        </div>
    <div class="row">
        <div class="col">
            <!--Početak tablice-->
            <table class="table text-yellow text-center">
                <thead>
                    <tr>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>E-mail</th>
                        <th>Tip korisnika</th>
                        <th>Promjeni tip</th>
                    </tr>
                </thead>
                <tbody>
                    <!--Petlja-->
                    <?php foreach($korisnici as $korisnik):?>
                        <tr>
                            <td><?php echo $korisnik->ime;?></td>
                            <td><?php echo $korisnik->prezime;?></td>
                            <td><?php echo $korisnik->email;?></td>
                            <td><?php echo $korisnik->tip_korisnika;?></td>
                            <?php if ($korisnik->tip_korisnika == "korisnik"):?>
                                <td><a href="<?php echo site_url('admin/promjenikorisnika/'.$korisnik->id.'/1');?>"><img
                                src="<?php echo base_url('assets/icons/upy16.png');?>">Administrator<img
                                src="<?php echo base_url('assets/icons/upy16.png');?>"></a></td>
                            <?php else:?>
                                <td><a href="<?php echo site_url('admin/promjenikorisnika/'.$korisnik->id.'/2');?>"><img
                                src="<?php echo base_url('assets/icons/downy16.png');?>">Korisnik<img
                                src="<?php echo base_url('assets/icons/downy16.png');?>"></a></td>
                            <?php endif;?>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>