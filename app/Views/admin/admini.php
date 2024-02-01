<div class="container-fluid text-yellow h-100">
    <div class="row justify-content-center text-center">
        <div class="col">
            <br><h1>Administratori</h1><br>
        </div>
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
                        <th>Promjeni tip</th>
                    </tr>
                </thead>
                <tbody>
                    <!--Petlja-->
                    <?php foreach($administratori as $administrator):?>
                        <tr>
                            <td><?php echo $administrator->ime;?></td>
                            <td><?php echo $administrator->prezime;?></td>
                            <td><?php echo $administrator->email;?></td>
                            <td><a href="<?php echo site_url('admin/promjenikorisnika/'.$administrator->id.'/2');?>"><img
                            src="<?php echo base_url('assets/icons/downy16.png');?>">Korisnik<img
                            src="<?php echo base_url('assets/icons/downy16.png');?>"></a></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>