<?php

/**
 * @author Umar Riaz
 * Created at 01/07/2020
 * Updated at 24/01/2024
 */
?>

<?= $this->extend('layout/master') ?>
<?= $this->section('content') ?>
<div class="MidContainer mx-auto">
  <fieldset class="mt-2 editFeildset">
        <div class="tittle text-center mb-0">
            <h4 class="mb-0 text-center fs-2">Page Under Maintenance</h4>
            <!-- <i id="editResearcherInfo" class="bi bi-pencil-square updateData btn btn-small btn-outline-success float-end" data-bs-toggle="modal" data-bs-target="#editConditionsModal"></i> -->
        </div>
        <hr>
        <div class="card-body">
            <p>We are working hard to bring you an awesome experience!</p>
            <img src="<?php echo base_url('public/img/deve.gif') ?>" alt="img 2">

        </div>
    </fieldset>

</div>
<?= $this->endSection() ?>