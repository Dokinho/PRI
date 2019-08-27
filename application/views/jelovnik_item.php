<div class="card mx-2 my-3">
    <img src="<?php echo base_url($slika);?>" class="card-img-top">
    <div class="card-body">
        <h3 class="card-title"><?php echo $naziv;?></h3>
        <p class="card-text"><?php echo $opis;?></p>
    </div>
    <div class="card-footer">
    <table class="table table-borderless text-yellow">
            <tbody>
                <tr>
                    <td scope="row">Mala</td>
                    <td scope="row">
                        <form class="form-inline justify-content-end" action="<?php echo site_url('jelovnik/dodaj/'.$id.'/mala');?>">
                            <label class="form-text"><?php echo $cijena_m;?> kn</label>
                            <input type="image" class="add" src="<?php echo base_url('assets/icons/plus24.png');?>">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td scope="row">Srednja</td>
                    <td scope="row">
                        <form class="form-inline justify-content-end" action="<?php echo site_url('jelovnik/dodaj/'.$id.'/srednja');?>">
                            <label class="form-text"><?php echo $cijena_s;?> kn</label>
                            <input type="image" class="add" src="<?php echo base_url('assets/icons/plus24.png');?>">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td scope="row">Jumbo</td>
                    <td scope="row">
                        <form class="form-inline justify-content-end" action="<?php echo site_url('jelovnik/dodaj/'.$id.'/jumbo');?>">
                            <label class="form-text"><?php echo $cijena_j;?> kn</label>
                            <input type="image" class="add" src="<?php echo base_url('assets/icons/plus24.png');?>">
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>