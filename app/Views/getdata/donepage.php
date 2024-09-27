<?php

/**
 * @author Umar Riaz
 * Created at 16/04/2021
 * 
 */ ?>
<?= $this->extend('layout/master') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="card main-card1">
        <div class="card-body">
            <div class="done card">
                <div class="row ">
                    <div class="col-12 text-center">Thank You!</div>
                    <div class="col-12 text-justify">Your Dataset has been successfully added.
                        An access link to view the data has been sent to your user email address.
                        You can view your submission or add more datasets using the following options.
                    </div>
                </div>
                <hr>
                <div class="text-center ">
                    <form id="addMoreData" action="<?php echo base_url('/getdata/addmoredata'); ?>" method="post">
                        <input type="hidden" name="fname" value="<?php echo $fname ?>">
                        <input type="hidden" name="lname" value="<?php echo $lname ?>">
                        <input type="hidden" name="role" value="<?php echo $role ?>">
                        <input type="hidden" name="email" value="<?php echo $email ?>">
                        <input type="submit" name="Submit" class="btn mpbtn" id="Submit" value="Add another dataset" />
                        <a href="<?php echo base_url('/Editdata/view/' . $id) ?>" class="btn mpbtn">View submission</a>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
<?= $this->endSection() ?>