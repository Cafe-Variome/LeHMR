<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container-fluid">
    <div class="navbar-brand">
        <a href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url('public/img/lehmrLogo.png') ?>" class="logo" alt="LeHMR">
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="max-width: 510px;margin-left: auto; min-width: 300px;">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="width: -webkit-fill-available !important;">
        <?php $request = service('request'); ?>
        <li class="nav-item">
            <a id ="home" class="nav-link" href="<?php echo base_url()?>"> Home</a>
        </li>
        <li class="nav-item">
            <a id ="adddata" class="nav-link" href="<?php echo base_url('/Getdata/index') ?>">Add Data</a>
        </li>
        <li class="nav-item dropdown">
            <a id ="editdata" class="nav-link" href="<?php echo base_url('/editdata') ?>">Edit Data</a>
        </li>
        <li class="nav-item">
            <a  id ="explore" class="nav-link" href="<?php echo base_url('/discover') ?>" target="_blank">Explore Datasets</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

