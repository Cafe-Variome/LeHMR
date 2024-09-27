<?php

/**
 * @author Umar Riaz
 * Created at 21/08/2024
 */
?>

<?= $this->extend('layout/master') ?>
<?= $this->section('content') ?>
<div class="MidContainer mx-auto">
    <div class="multi_step_form">
        <form id="requestAccessForm" class="msform " action="" method="post" >
            <fieldset  class="mt-1 formFeildset">
                <div class="tittle text-center mb-0">
                    <h4 class="mb-0 text-center">Please enter user information</h4>
                    <small class="text-muted">An access link to your datasets will be sent to the email you used when adding the dataset.</small>
                </div>
                <hr>
                <div id="userinformation">
                    <div class="row mt-3 p-0">
                        
                        <div class="form-group col-md-6 col-6 col-12">
                            <label for="u_fname" class="nl" >First Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="text" class="form-control" value="<?php if(isset($fname))echo $fname ?>"  name="u_fname" id="u_fname" placeholder="Please enter first name">
                            <em class="help_block error text-danger" id ="u_fname-error"></em>
                        </div>
                        <div class="form-group col-md-6 col-6 col-12">
                            <label for="u_lname" class="nl" >Last Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="text" class="form-control" value="<?php if(isset($lname))echo $lname ?>"  name="u_lname" id="u_lname" placeholder="Please enter last name">
                            <em class="help_block error text-danger" id ="u_lname-error"></em>
                        </div>
                    </div>
                    <div class="row mt-1 p-0">
                        <div class="form-group col-md-12 col-12 col-12">
                            <label for="u_email" class="nl">Email:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="email" class="form-control" value="<?php if(isset($email))echo $email ?>"  name="u_email" id="u_email" placeholder="Please enter email">
                            <em class="help_block error text-danger" id ="u_email-error"></em>
                        </div>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn action-button">Submit</button>
            </fieldset>
        </form>
    </div>
</div>
<?= $this->endSection() ?>