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
    <div class="multi_step_form">
        <form id="msform" class="msform " action="" method="post" >
            <!-- progressbar -->
            <ul id="progressbar">
                <li id="uinfo" class="active"><div class="d-none d-sm-block">User Info</div></li>
                <li id="dinfo"><div class="d-none d-sm-block">Dataset</div></li>
                <li id="rinfo"><div class="d-none d-sm-block">Researchers</div></li>
                <li id="cinfo"><div class="d-none d-sm-block">Use Conditions</div></li>
                <li id= "pinfo"><div class="d-none d-sm-block">Publications</div></li>
                <li id="sinfo"><div class="d-none d-sm-block">Summary</div></li>

            </ul>

            <div id="submitMessage"></div>

            <!-- fieldsets -->
            <!-- User Info -->
            <fieldset id="userinfofield" class="mt-2 formFeildset">
                <div class="tittle text-center mb-0">
                    <h4 class="mb-0 text-center">User Information</h4>
                    <small class="text-muted mr-2">All fields marked with </small><small class="text-danger"><i class="bi bi-asterisk"> </i></small><small class="text-muted ml-2"> are mandatory.</small>
                </div>
                <hr>
                <div id="userinformation">
                    <input type="hidden" name="step" value="one">
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
                        <div class="form-group col-md-6 col-6 col-12">
                            <label for="u_role" class="nl">Role:</label>
                            <input type="text" class="form-control" value="<?php if(isset($role))echo $role ?>" name="u_role" id="u_role" placeholder="Please specify you role">
                            <em class="help_block error text-danger" id ="u_role-error"></em>
                        </div>
                        <div class="form-group col-md-6 col-6 col-12">
                            <label for="u_email" class="nl">Email:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="email" class="form-control" value="<?php if(isset($email))echo $email ?>"  name="u_email" id="u_email" placeholder="Please enter email">
                            <em class="help_block error text-danger" id ="u_email-error"></em>
                        </div>
                    </div>
                </div>
                <hr>
                <button id="userInfo" class="next btn action-button">Dataset</button>
                <button id="userToSum" class="btn action-button backToSum">Summary</button>
            </fieldset>
            <fieldset id="datasetfield" class="mt-2 formFeildset">
                <div class="tittle text-center mb-0">
                    <h4 class="mb-0 text-center">Dataset Information</h4>
                    <small class="text-muted mr-2">All fields marked with </small><small class="text-danger"><i class="bi bi-asterisk"> </i></small><small class="text-muted ml-2"> are mandatory.</small>
                </div>
                <hr>
                <div id="dataset">
                    <input type="hidden" name="step" value="two">
                    <div class="row p-0">
                        <div class="form-group col-md-6 col-sm-12 col-12">
                            <label for="d_title" class="nl">Dataset Title:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <textarea type="text" placeholder="Please enter title of dataset"  rows="3" minlength="1" maxlength="200" data-original-title="Title" class="form-control" name="d_title" id="d_title"></textarea>
                            <em class="help_block error text-danger" id ="d_title-error"></em>
                            <small class="text-muted remText" id="d_titlerem"></small>
                        </div>
                        <div class="form-group col-md-6 col-sm-12 col-12">
                            <label for="d_abstract" class="nl" >Abstract:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <textarea type="textarea" class="form-control"  placeholder="Please enter abstract of the dataset" maxlength="500" rows="3" name="d_abstract" id="d_abstract"></textarea>
                            <em class="help_block error text-danger" id ="d_abstract-error"></em>
                            <small class="text-muted remText" id="d_abstractrem"></small>
                        </div>
                    </div>
                    <hr>
                    <div class="row p-0">
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12">
                            
                            <span id="theme" class="input-group">
                                <label class="nl" for="d_datatheme">Theme or Department:</label>
                                <select name="d_datatheme[]" id="d_datatheme" multiple class="form-control">
                                    <option></option>
                                    <option>Cardiovascular</option>
                                    <option>Lifestyle</option>
                                    <option>Respiratory</option>
                                </select>
                            </span>
                            <em class="help_block error text-danger" id ="d_datatheme-error"></em>
                            <input type="text" class="backvalue" name="d_datatheme" id="d_datathemevalue">
                        </div>
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12">
                            <span id="funders" class="input-group">
                                <label class="nl" for="d_funders">Funders:</label>
                                <select type="text" name="d_funders[]" id="d_funders" class="form-control" multiple="multiple">
                                    <option></option>
                                </select>
                            </span>
                            <em class="help_block error text-danger" id ="d_funders-error"></em>
                            <input type="text" class="backvalue" name="d_funders" id="d_fundervalue">
                        </div>
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12">
                            <span id="ethnicity" class="input-group">
                                <label class="nl" for="d_ethnicity">Ethnicity:</label>
                                 <select type="text" name="d_ethnicity[]" id="d_ethnicity" class="form-control" multiple="multiple">
                                    <option></option>
                                </select>
                            </span>
                            <em class="help_block error text-danger" id ="d_ethnicity-error"></em>
                            <input type="text" name="d_ethnicity" class="backvalue" id="d_ethnicityvalue">
                        </div>
                        

                    </div> <!--End Row-->
                    <hr>
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12">
                            <label class="nl" for="d_datatypes">Data Types:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <span id="datatype" class="input-group">
                                <select type="text" class="form-control d_datatypes"  name="d_datatypes[]" multiple="multiple" id="d_datatypes">
                                </select>
                            </span>
                            <em class="help_block error text-danger" id ="d_datatypes-error"></em>
                            <input type="text" class="backvalue" name="d_datatypes"  id="d_datatypevalue">
                        </div>

                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12">
                            <label for="d_keyword" class="nl">Keywords:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <span class="input-group" id="keywords">
                                <select type="text" class="form-control"  name="d_keyword[]" id="d_keyword" multiple="multiple">
                                    <option></option>
                                </select>
                            </span>
                            <em class="help_block error text-danger" id ="d_keywords-error"></em>
                            <input type="text" name="d_keywords" class="backvalue"  id="d_keywordvalue">
                            <small class="text-muted remText">You can add upto 10 keywords.</small>
                        </div>
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12">
                            <label class="nl" for="d_researchstudy">Research Project:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="text" class="form-control" placeholder="Please enter research study name that produced data" name="d_researchstudy"  id="d_researchstudy">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12">
                            <label class="nl" for="d_geography">Geographical Coverage:</label>
                            <!-- <input type="text" class="form-control" placeholder="write the geographical area name and press enter" name="d_geography" id="d_geography" data-role="tagsinput"> -->
                                <span id="geography" class="input-group">
                                    <select type="text" name="d_geography[]" id="d_geography" class="form-control" multiple>
                                        <option></option>
                                    </select>
                                </span>
                            <em class="help_block error text-danger" id ="d_geography-error"></em>
                            <input type="text" name="d_geography" class="backvalue" id="d_geographyvalue">
                        </div>
                        <!-- Age Range and Study Size -->
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12" id="studysize">
                            <label class="nl" for="d_studysize">Study Size:</label>
                            <input type="number" name="d_studysize" id="d_studysize" min="0"  class="form-control" placeholder="Study Size">
                            <em class="help_block error text-danger" id ="d_studysize-error"></em>
                        </div>
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12" id="agerange">
                            <label>Age Range:</label>
                            <div class="row input-group">
                                <div class="col-md-8 col-sm-8 col-8">
                                    <div id="Ar-range" class=" mt-2 sl rs"></div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12  col-4">
                                    <input type="text" id="Ar-value" name="Ar-value" readonly class="rangeText">
                                    <input type="text" disabled style="display: none" aria-hidden="true" id="d_agerange" name="d_agerange">
                                    <em class="help_block error text-danger" id ="d_agerange-error"></em>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row p-0">
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12" id="accessright">
                            <label class="nl">Access Rights:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="url" name="d_arights" id="d_arights" class="form-control"  placeholder="https://www.example.com">
                            <em class="help_block error text-danger" id ="d_arights-error"></em>  
                        </div>
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12" id="orgnisationfield">
                            <label class="nl" for="d_organisation">Organisation:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="text" name="d_organisation" id="organisation" placeholder="Please enter organisation name" class="form-control">
                            <em class="help_block error text-danger" id ="d_organisation-error"></em>   
                        </div>
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12" id="conpointfield">
                            <label class="nl" for="d_conpoint">Contact Point:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="email" name="d_conpoint"  placeholder="Please enter email" id="d_conpoint" class="form-control">
                            <em class="help_block error text-danger" id ="d_conpoint-error"></em>   

                        </div>
                    </div>
                    <hr>
                    <div class="row p-0">
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12">
                            <label class="nl" for="d_controler">Data Controller:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <textarea type="textarea" class="form-control"  placeholder="Please enter data controller" maxlength="200" rows="1" name="d_controler" id="d_controler"></textarea>
                            <small class="text-muted remText" id="d_controlerrem"></small>
                            <em class="help_block error text-danger" id ="d_controler-error"></em>   
                        </div>
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12">
                            <label class="nl" for="d_legaljurisdictionvalue">Legal Jurisdiction:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <span id="legalJ" class="input-group">
                                <select name="d_legaljurisdiction[]" id="d_legaljurisdiction" class="form-control d_legaljurisdiction" multiple="multiple">
                                <option></option>
                                </select>
                            </span>
                            <em class="help_block error text-danger" id ="d_legaljurisdiction-error"></em>   
                            <input type="text" class="backvalue" name="d_legaljurisdiction"  id="d_legaljurisdictionvalue" autocomplete="off">
                        </div>
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12">
                            <span id="hconsent" class="input-group">
                                <label class="nl" for="d_hdrconsent">Syndicate with HDR-UK Gateway:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                                <select name="d_hdrconsent" id="d_hdrconsent"  class="form-control">
                                    <option></option>
                                    <option value="1">Yes</option>
                                    <option value="0"> No </option>
                                </select>
                            </span>
                            <em class="help_block error text-danger" id ="d_hdrconsent-error"></em>   
                        </div>

                    </div>
                </div>
                <hr>
                <button type="button"   class="previous btn action-button">User Info</button>
                <button   id="dataInfo" class="next btn action-button">Researchers</button>
                <button type="button" id="dataToSum" class="btn action-button backToSum">Summary</button>
            </fieldset> <!-- Dataset Info End-->
            <!-- Researchers -->
            <fieldset id="personinfo" class="mt-2 formFeildset">
                <div class="tittle text-center mb-0">
                    <h4 class="mb-0 text-center">Researchers</h4>
                    <small class="text-muted mr-2">Optional-Please enter researchers related to dataset if applicable.</small>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12" id="persons">
                        <input type="hidden" name="step" value="three">

                    </div>
                </div>
                <div class="row mb-4">
                <div class="col-md-2 col-2"> <button type="button" id="addperson" class="form-control btn btn-light"><i class="bi bi-plus-lg"></i>Researcher</button></div>
                </div>
                <hr>
                <button type="button"   class="previous btn action-button">Dataset</button>
                <button type="button"   class="next btn action-button" id="perInfo"   >Use Conditions</button>
                <button type="button" id="personToSum" class=" btn action-button backToSum" value="Summary" >Summary</button>
            </fieldset>
                    <!-- Use Conditions -->
            <fieldset id="conditioninfo" class="mt-2 formFeildset">
                <div class="tittle text-center mb-0">
                    <h4 class="mb-0 text-center">Conditions of Use</h4>
                </div>
                <hr>
                <div id="condition">
                    <input type="hidden" name="step" value="four">
                    <div class="row mt-3">
                        <div class="form-group col-md-6">
                            <label class="nl" for="c_allowedcountries">Allowed Countries:</label>
                            <span id="allowedC" class="input-group">
                                <select name="c_allowedcountries" id="" class="form-control c_allowedcountries" multiple="multiple">
                                    <option></option>
                                </select>
                            </span>
                            <em class="help_block error text-danger" id="c_allowedcountries-error"></em>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="nl" for="c_profituse">Profit Use:</label>
                            <span id="pUse" class="input-group">
                                <select name="c_profituse" id="c_profituse" class="form-control">
                                    <option></option>
                                </select>
                            </span>
                            <em class="help_block error text-danger" id="c_profituse-error"></em>
                        </div>
                        <div class="form-group col-md-3 col-sm-3 col-12">
                            <label class="nl" for="c_contact">Recontact:</label>
                            <span id="reCon" class="input-group">
                                <select name="c_contact" id="c_contact" class="form-control">
                                    <option></option>
                                </select>
                            </span>
                            <em class="help_block error text-danger" id="c_contact-error"></em>
                        </div>
                    </div>
                    <div class="row mb-3 mt-3">
                        <div class="form-group col-md-6">
                            <label class="nl" for="c_bru">Broad Research Uses:</label>
                            <span id="bru" class="input-group">
                                <select class="form-control c_bru" type="text" name="c_bru" multiple="multiple"></select>
                            </span>
                            <em class="help_block error text-danger" id="c_bru-error"></em>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="nl" for="c_cru">Specific Research Uses:</label>
                            <span id="sru" class="input-group">
                                <select class="form-control c_sru" name="c_sru" multiple="multiple"></select>
                            </span>
                            <em class="help_block error text-danger" id="c_sru-error"></em>
                        </div>
                    </div>
                </div>


                <hr>
                <button type="button"   class="btn previous action-button"  >Researchers</button>
                <button type="button" id="conInfo"   class="btn next action-button"  >Publication</button>
                <button type="button" id="conToSum" class=" btn action-button backToSum" value="Summary">Summary</button>
            </fieldset>

            <!-- Publication Information -->
            <fieldset id="publicationinfo" class="mt-2 formFeildset">
                <div class="tittle text-center mb-0">
                    <h4 class="mb-0 text-center">Publications</h4>
                    <small class="text-muted mr-2"> Optional-Please enter publications related to dataset if applicable.</small>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12" id="publications">
                        <input type="hidden" name="step" value="five">

                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col-md-2 col-2 "><button type="button" id="addpublication" class=" form-control btn btn-light"><i class="bi bi-plus-lg"></i> Publications</button></div>
                </div>
                <hr>
                <button type="button"  class="btn previous action-button">Use Conditions</button>
                <button type="button" id="pubInfo"   class="btn next action-button">Summary</button>

            </fieldset>  
             <!--Summary Field  -->
             <fieldset id="summaryField" class="mt-2 formFeildset">
                <div class="tittle text-center mb-0">
                    <h4 class="mb-0 text-center">Summary</h4>
                    <small class="text-muted mr-2"> Please review your submission.</small>
                </div>
                <div class="row">
                    <div id="summary" class="mt-3 mb-2 col-12">
                        <table class="table table-striped table-bordered col-12">
                            <colgroup>
                                <col span="1" style="width: 20%;">
                                <col span="1" style="width: 80%">
                            </colgroup>
                            <thead class="thead-dark" style="display: none;">
                                <tr class="row">
                                    <th scope="col">Input</th>
                                    <th scope="col">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <thead>
                                    <tr>
                                        <td  colspan=2>
                                            <div class="row">
                                                <h4 class="col-11 text-center">User Information</h4>
                                                <i id="edituserinfo" class="bi bi-pencil-square edit btn btn-small btn-outline-success  float-end"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>
                            </tbody>
                            <tbody id="userinfobody"></tbody>
                            <tbody>
                                <thead>
                                    <tr>
                                        <td  colspan=2>
                                            <div class="row">
                                                <h4 class="col-11 text-center">Dataset Information</h4>
                                                <i id="editdatasetinfo" class="bi bi-pencil-square edit btn btn-small btn-outline-success  float-end"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>
                            </tbody>
                            <tbody id="datainfobody"></tbody>
                            <tbody>
                                <thead>
                                    <tr>
                                        <td  colspan=2>
                                            <div class="row">
                                                <h4 class="col-11 text-center">Researchers</h4>
                                                <i id="editpersoninfo" class="bi bi-pencil-square edit btn btn-small btn-outline-success  float-end"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>
                            </tbody>
                            <tbody id="personbody"></tbody>
                            <tbody>
                                <thead>
                                    <tr>
                                        <td  colspan=2>
                                            <div class="row">
                                                <h4 class="col-11 text-center">Use Conditions</h4>
                                                <i id="editconinfo" class="bi bi-pencil-square edit btn btn-small btn-outline-success  float-end"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>
                            </tbody>
                            <tbody id="conditionbody"></tbody>
                            <tbody>
                                <thead>
                                    <tr>
                                        <td  colspan=2>
                                            <div class="row">
                                                <h4 class="col-11 text-center">Publications</h4>
                                                <i id="editpubinfo" class="bi bi-pencil-square edit btn btn-small btn-outline-success  float-end"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>
                            </tbody>
                            <tbody id="publicationbody"></tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <button type="button" name="previous" class="btn previous action-button">Publication</button>
                <!-- <button type="submit" disabled style="display: none" aria-hidden="true"></button> -->
                <button type="submit" name="Submit" class="btn action-button" id="Submit">Submit</button>
             </fieldset>
        </form>
    </div>
</div>


<script>
    $('#reset_query').click(function() {
        location.reload();
    });
</script>

<?= $this->endSection() ?>