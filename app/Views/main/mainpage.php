<?php
/**
 * @author Umar Riaz
 * Created at 23/02/2021
 * Updated 23/01/2024
 */
?>
<?= $this->extend('layout/master') ?>
<?= $this->section('content') ?>
  <div class="homepageContainer">
    <div class="row">
      <div class="col">
        <img src="<?php echo base_url('public/img/RedBlockUoLlogo.png') ?>" class="imageR" alt="img 1">
        <img src="<?php echo base_url('public/img/brclog.png') ?>" class="imgR" alt="img 2">
      </div>
    </div>
    <div class="row mt-2 con">
        <p>Leicester researchers and clinicians have produced a large number of biomedical datasets from cohort studies, clinical trials, healthcare practice, and audit projects. These constitute a valuable resource that can be shared to facilitate new analyses and original discoveries.</p>
        <p>To maximise their wider/secondary use in a responsible manner, NIHR Leicester BRC and HDR UK Leicester have established the "Leicester Health & Medical Data for Research" (LeHMR). This platform will list the wealth of local academic and healthcare datasets that researchers can request access to. This work operates in synergy with the <a href="https://www.healthdatagateway.org/" target="_blank">HDR UK Innovation Gateway</a>.</p>
        <p>"LeHMR Online" is a simple platform that enables PIs, or nominated members of their team, to manage/submit metadata about their datasets (e.g., description, researchers, publications, data use conditions) so that they can be easily discovered by internal and external researchers.</p>
        <p>Leicester investigators are therefore now invited and encouraged to use LeHMR (with support available from the BRC and HDR UK informatics teams) to provide core metadata and make this visible from the LeHMR platform. Investigators have the option to request that their datasets are also made visible from the national HDR UK Innovation Gateway.</p>
        <p>For further details about LeHMR please contact <a href="" id="timb">Tim Beck</a>,<a id="tims" href=""> Tim Skelton</a> or <a id="tonyb" href="">Anthony Brookes </a>.
          For technical assistance or to get help to use the interface please contact <a id="umar" href="">Umar Riaz.</a></p>
    </div>
    <hr>
    <div class="text-center mb-3">
      <a href="<?php echo base_url('/Getdata/index') ?>" class="btn mpbtn">Add Data</a>
      <a href="<?php echo base_url('/Editdata/viewdata') ?>" class="btn mpbtn">Edit Data</a>
      <a href="<?php echo base_url('/developing') ?>" target="_blank" class="btn mpbtn">Explore Datasets</a>
    </div>
    

    
  </div>
  <script>
    $(document).ready(function() {

        var tb = $('#timb');
        var ts = $('#tims');
        var tob = $('#tonyb');
        var mm = $('#monm');
        var umar = $('#umar')
        tb.on('click', function(e) {
          window.location.href = "mailto:timbeck@leicester.ac.uk?subject=LeHMR Query!";
        })
        ts.on('click', function(e) {
          window.location.href = "mailto:tim.skelton@uhl-tr.nhs.uk?subject=LeHMR Query!";
        })
        tob.on('click', function(e) {
          window.location.href = "mailto:ajb97@leicester.ac.uk?subject=LeHMR Query!";
        })
        mm.on('click', function(e) {
          window.location.href = "mailto:mm597@leicester.ac.uk?subject=LeHMR Query!";
        })
        umar.on('click', function(e) {
          window.location.href = "mailto:ur13@leicester.ac.uk?subject=LeHMR Query!";
        })
    })
</script>
<?= $this->endSection() ?>