<?php helper('form') ?>
<div class="container-fluid text-yellow" id="bghome">
  <div class="row justify-content-center align-items-center text-center" style="height: 75%">
    <div class="col forma">
      <h1>Prijava</h1><br>
      <form action="<?php echo site_url('login');?>" method="post">
        <div class="form-group">
          <label class="form-text" for="email">Email</label>
          <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email');?>">
          <?php //echo form_error('email');?>
        </div>
        <div class="form-group">
          <label class="form-text" for="lozinka">Lozinka</label>
          <input type="password" class="form-control" name="lozinka" id="lozinka">
          <?php //echo form_error('lozinka');?>
        </div><br>