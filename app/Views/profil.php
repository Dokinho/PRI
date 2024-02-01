<div class="container-fluid text-yellow">
    <div class="row justify-content-center text-center">
        <div class="col align-items-center">
            <nav class="navbar navbar-expand justify-content-center">
                <!--Osobni podaci-->
                <ul class="navbar-nav flex-column">
                    <li class="nav-item">
                        <a href="<?php echo site_url('profil/index/podaci');?>"><img src="<?php echo base_url('assets/icons/info32.png');?>"></a>
                    </li>
                    <li class="nav-item">Podaci</li>
                </ul>
                <!--Naslov-->
                <ul class="navbar-nav">
                    <li class="nav-item" id="profil-naslov">
                        <span class="navbar-brand mx-auto font-weight-bold"><h1>Profil</h1></span>
                    </li>
                </ul>
                <!--Adrese-->
                <ul class="navbar-nav flex-column">
                    <li class="nav-item">
                        <a href="<?php echo site_url('profil/index/adrese');?>"><img src="<?php echo base_url('assets/icons/house32.png');?>"></a>
                    </li>
                    <li class="nav-item">Adrese</li>
                </ul>
            </nav>
        </div>
    </div>