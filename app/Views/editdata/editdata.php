<?php

/**
 * @author Umar Riaz
 * Created at 30/08/2024
 */
?>

<?= $this->extend('layout/master') ?>
<?= $this->section('content') ?>
<div class="MidContainer mx-auto">
<div class="container mt-5">
    <!-- Dataset Information -->
     <fieldset  class="mt-3 float-start editFeildset fitcon">
        <button id="backButton" class=" btn mpbtn">Back</button>
    </fieldset>
    <fieldset id="datasetField" class="mt-2 editFeildset ">
        <div class="tittle text-center mb-0">
            <h4 class="mb-0 text-center fs-2">Dataset Information</h4>
            <i id="editDatasetInfo" class="bi bi-pencil-square updateData btn btn-small btn-outline-success float-end" data-bs-toggle="modal" data-bs-target="#editDatasetModal"></i>
        </div>
        <hr>
        <div class="card-body">
        <table class="table table-bordered">
            <?php foreach ($dataFields as $field => $label): ?>
                <?php if (!empty($dataset[$field])): ?>
                    <tr>
                        <th class="text-start fs-5"><?= esc($label) ?></th>
                        <td class="text-start text-wrap"><?= esc($dataset[$field]) ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>
    </fieldset>


    <!-- Researchers -->
    <fieldset class="mt-2 editFeildset">
        <div class="tittle text-center mb-0">
            <h4 class="mb-0 text-center fs-2">Researchers</h4>
            <i id="editResearcherInfo" class="bi bi-pencil-square updateData btn btn-small btn-outline-success float-end" data-bs-toggle="modal" data-bs-target="#editResearchersModal"></i>
        </div>
        <hr>
        <div class="card-body">
            <div id="researchers" class>
                <table class="table table-bordered">
                    <?php foreach ($researchers as $index => $resercher): ?>
                        <tr><td class="fs-4 text-center" colspan="2">Researcher <?= esc($index +1 )?></td></tr>
                        <?php foreach ($dataFields as $field => $label): ?>
                            <?php if (!empty($resercher[$field])): ?>
                                <tr>
                                    <th class="text-start fs-5"><?= esc($label) ?></th>
                                    <td class="text-start text-wrap"><?= esc($resercher[$field]) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </fieldset>

    <!-- Publications -->
    <fieldset class="mt-2 editFeildset">
        <div class="tittle text-center mb-0">
            <h4 class="mb-0 text-center fs-2">Publications</h4>
            <i id="editResearcherInfo" class="bi bi-pencil-square updateData btn btn-small btn-outline-success float-end" data-bs-toggle="modal" data-bs-target="#editPublicationsModal"></i>
        </div>
        <hr>
        <div class="card-body">
            <div id="publicationsField">
                <table class="table table-bordered">
                    <?php foreach ($publications as $index => $publication): ?>
                        <tr><td class="fs-4 text-center" colspan="2">Publication <?= esc($index +1 )?></td></tr>
                        <?php foreach ($dataFields as $field => $label): ?>
                            <?php if (!empty($publication[$field])): ?>
                                <tr>
                                    <th class="text-start fs-5"><?= esc($label) ?></th>
                                    <td class="text-start text-wrap"><?= esc($publication[$field]) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </fieldset>

    <!-- Conditions -->
    <fieldset class="mt-2 editFeildset">
        <div class="tittle text-center mb-0">
            <h4 class="mb-0 text-center fs-2">Use Conditions</h4>
            <i id="editResearcherInfo" class="bi bi-pencil-square updateData btn btn-small btn-outline-success float-end" data-bs-toggle="modal" data-bs-target="#editConditionsModal"></i>
        </div>
        <hr>
        <div class="card-body">
            <div id="conditions">
                <table class="table table-bordered">
                    <?php foreach ($dataFields as $field => $label): ?>
                        <?php if (!empty($conditions[$field])): ?>
                            <tr>
                                <th class="text-start fs-5"><?= esc($label) ?></th>
                                <td class="text-start text-wrap"><?= esc($conditions[$field]) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </fieldset>
</div>



<!-- Dataset Modal -->
<div class="modal fade" id="editDatasetModal" tabindex="-1" aria-labelledby="editDatasetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="mb-0 text-center">Update Dataset Information</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="datasetEditForm">
                        <input type="hidden" id="encrypted_id" name="d_id" value="<?= $dataset['encrypted_id']; ?>">
                        <!-- <input type="hidden" name="section" value="dataset"> -->

                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="d_title" class="form-label">Dataset Title:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <textarea name="d_title" id="d_title" class="form-control" rows="3"><?= $dataset['d_title']; ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="d_abstract" class="form-label">Abstract:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <textarea name="d_abstract" id="d_abstract" class="form-control" rows="3"><?= $dataset['d_abstract']; ?></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-lg-4">
                            <label for="d_datatheme" class="form-label">Theme or Department:</label>
                            <select name="d_datatheme[]" id="d_datatheme" multiple class="form-control selectpicker">
                                <?php if (!empty($dataset['d_theme'])): ?>
                                    <?php $themes = explode(';', $dataset['d_theme']);?>
                                    <?php foreach ($themes as $theme): ?>
                                        <option value="<?= $theme; ?>" <?= $theme ? 'selected' : ''; ?>><?= $theme; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="d_funders" class="form-label">Funders:</label>
                            <select name="d_funders[]" id="d_funders" multiple class="form-control selectpicker">
                                <?php if (!empty($dataset['d_funders'])): ?>
                                    <?php $funders = explode(';', $dataset['d_funders']);?>

                                    <?php foreach ($funders as $funder): ?>
                                        <option value="<?= $funder; ?>" <?= $funder ? 'selected' : ''; ?>><?= $funder; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="d_ethnicity" class="form-label">Ethnicity:</label>
                            <select name="d_ethnicity[]" id="d_ethnicity" multiple class="form-control selectpicker">
                                <?php if (!empty($dataset['d_ethnicities'])): ?>
                                    <?php $ethnicities = explode(';', $dataset['d_funders']);?>
                                    <?php foreach ($ethnicities as $ethnicity): ?>
                                        <option value="<?= $ethnicity; ?>" <?= $ethnicity ? 'selected' : ''; ?>><?= $ethnicity; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-lg-4">
                            <label for="d_datatypes" class="form-label">Data Types:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <select name="d_datatypes[]" id="d_datatypes" multiple class="form-control selectpicker">
                                <?php if(!empty($dataset['d_datatypes'])):?>
                                    <?php $datatypes = explode(';', $dataset['d_datatypes']);?>
                                    <?php foreach ($datatypes as $datatype): ?>
                                        <option value="<?= $datatype; ?>" <?= $datatype ? 'selected' : ''; ?>><?= $datatype; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="d_keyword" class="form-label">Keywords:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <select name="d_keyword[]" id="d_keyword" multiple class="form-control selectpicker">
                                <?php if (!empty($dataset['d_keywords'])): ?>
                                    <?php $keywords = explode(';', $dataset['d_keywords']); ?>
                                    <?php foreach ($keywords as $keyword): ?>
                                        <option value="<?= $keyword; ?>" <?= $keyword ? 'selected' : ''; ?>><?= $keyword; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="d_researchstudy" class="form-label">Research Project:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="text" name="d_researchstudy" id="d_researchstudy" class="form-control" value="<?= $dataset['d_researchstudy']; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-lg-4">
                            <label for="d_geography" class="form-label">Geographical Coverage:</label>
                            <select name="d_geography[]" id="d_geography" multiple class="form-control selectpicker">
                                <?php if (!empty($dataset['d_geographies'])): ?>
                                    <?php $geographies = explode(';', $dataset['d_geographies']); ?>
                                    <?php foreach ($geographies as $geography): ?>
                                        <option value="<?= $geography; ?>" <?= $geography ? 'selected' : ''; ?>><?= $geography; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="d_studysize" class="form-label">Study Size:</label>
                            <input type="number" name="d_studysize" id="d_studysize" min="0" class="form-control" value="<?= $dataset['d_studysize']; ?>">
                        </div>
                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-12" id="agerange">
                            <label>Age Range:</label>
                            <div class="row input-group">
                                <div class="col-md-8 col-sm-8 col-8">
                                    <div id="Ar-urange" class=" mt-2 sl rs"></div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12  col-4">
                                    <input type="text" id="Ar-uvalue" name="Ar-uvalue" readonly class="rangeText">
                                    <input type="text" disabled style="display: none"  aria-hidden="true" id="d_agerange" value="18-45" name="d_agerange">
                                    <em class="help_block error text-danger" id ="d_agerange-error"></em>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-lg-4">
                            <label for="d_arights" class="form-label">Access Rights:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="url" name="d_arights" id="d_arights" class="form-control" value="<?= $dataset['d_arights']; ?>">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="d_organisation" class="form-label">Organisation:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="text" name="d_organisation" id="d_organisation" class="form-control" value="<?= $dataset['d_organisation']; ?>">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="d_conpoint" class="form-label">Contact Point:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="email" name="d_conpoint" id="d_conpoint" class="form-control" value="<?= $dataset['d_conpoint']; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-lg-4">
                            <label for="d_controler" class="form-label">Data Controller:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <textarea name="d_controler" id="d_controler" class="form-control" rows="1"><?= $dataset['d_controler']; ?></textarea>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="d_legaljurisdiction" class="form-label">Legal Jurisdiction:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <select name="d_legaljurisdiction[]" id="d_legaljurisdiction" multiple class="form-control selectpicker">
                                <?php if (!empty($dataset['d_legaljurisdiction'])): ?>
                                    <?php $legalJurisdictions = explode(';', $dataset['d_legaljurisdiction']); ?>
                                    <?php foreach ($legalJurisdictions as $legalJurisdiction): ?>
                                        <option value="<?= $legalJurisdiction; ?>" <?= $legalJurisdiction ? 'selected' : ''; ?>><?= $legalJurisdiction; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="d_hdrconsent" class="form-label">Syndicate with HDR-UK Gateway:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <select name="d_hdrconsent" id="d_hdrconsent" class="form-control selectpicker">
                                <option value="1" <?= $dataset['d_hdrconsent'] == '1' ? 'selected' : ''; ?>>Yes</option>
                                <option value="0" <?= $dataset['d_hdrconsent'] == '0' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="updateDataset"form="datasetEditForm">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Researchers Modal -->
<div class="modal fade" id="editResearchersModal" tabindex="-1" aria-labelledby="editResearchersModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="mb-0 text-center">Update Researcher Information</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                
                <form id="researcherEditForm">
                    <input type="hidden" id="encrypted_id" name="d_id" value="<?= $dataset['encrypted_id']; ?>">
                    <div id="persons">
                        <?php foreach ($researchers as $index => $resercher): ?>
                            <div class="shadow-sm persongroup mt-3" id="per<?=esc($index);?>">
                                <div class="closebtn row">
                                    <div class="couter closebtn removePerson float-right" id="removePerson" style="margin-right: -1px !important; margin-top: -1rem !important;">
                                        <div class="cinner"><label>Remove</label></div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-md-6 col-12 col-sm-6">
                                        <label class="nl">Title:</label>
                                        <span class="input-group">
                                            <select name="researcher[<?=esc($index);?>][title]"  class="form-control per_title">
                                                <option selected><?=esc($resercher['p_title']);?></option>
                                            </select>
                                        </span>
                                        <em class="help_block error text-danger" id="researcher-<?=esc($index);?>-title-error"></em>
                                    </div>
                                    <div class="form-group col-md-6 col-6 col-sm-6">
                                        <label class="nl" for="per_email">Email: <small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                                        <input class="form-control" type="email" name="researcher[<?=esc($index);?>][email]" placeholder="Email of person"  value="<?= $resercher['p_email'];?>">
                                        <em class="help_block error text-danger" id="researcher-<?=esc($index);?>-email-error"></em>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-md-6 col-12 col-sm-6">
                                        <label class="nl" for="per_forename">Forename: <small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                                        <input type="text" name="researcher[<?=esc($index);?>][forename]" class="form-control" placeholder="Enter forename" value="<?= $resercher['p_firstname'];?>">
                                        <em class="help_block error text-danger" id="researcher-<?=esc($index);?>-forename-error"></em>
                                    </div>
                                    <div class="form-group col-md-6 col-12 col-sm-6">
                                        <label class="nl" for="per_surname">Surname: <small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                                        <input type="text" name="researcher[<?=esc($index);?>][surname]" class="form-control" placeholder="Enter surname" value="<?= $resercher['p_surname'];?>">
                                        <em class="help_block error text-danger" id="researcher-<?=esc($index);?>-surname-error"></em>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-md-12 col-sm-12 col-12">
                                        <label class="nl">Affiliations: <small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                                            <span id="affiliations" class="input-group">
                                            <select type="text" name="researcher[<?=esc($index);?>][affiliations]" class="form-control per_affiliation" multiple="multiple">
                                                <?php if (!empty($resercher['p_affiliations'])): ?>
                                                    <?php $affs = explode(';', $resercher['p_affiliations']); ?>
                                                    <?php foreach ($affs as $aff): ?>
                                                    <option value="<?= $aff; ?>" <?= $aff ? 'selected' : ''; ?>><?= $aff; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </span>
                                        <input type="text" class="backvalue per_affiliationvalue" name="researcher[<?=esc($index);?>][affiliations]">
                                        <em class="help_block error text-danger" id="researcher-<?=esc($index);?>-affiliations-error"></em>
                                    </div>    
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                </form>
                <div class="row mb-4">
                    <div class="col-md-2 col-2"> <button type="button" id="addperson" class="form-control btn btn-light"><i class="bi bi-plus-lg"></i>Researcher</button></div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="updateReseacher" form="researcherEditForm">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Publications Modal -->
<div class="modal fade" id="editPublicationsModal" tabindex="-1" aria-labelledby="editPublicationsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="editPublicationsForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPublicationsModalLabel">Update Publications</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="section" value="publications">
                    <input type="hidden" id="encrypted_id" name="d_id" value="<?= $dataset['encrypted_id']; ?>">
                    <div id="publications">
                        <?php foreach ($publications as $key => $pub):?>
                            <div class="shadow-sm pubgroup" id="pub<?= esc($key);?>">
                                <div class="closebtn row"><div class="couter closebtn removePub float-right" id="removePub"> <div class="cinner"><label>Remove</label></div></div></div>
                                <div class="row">
                                    <div class="form-group col-md-6 ">
                                        <label class="nl" for="p_title">Publication Title: <small class="text-danger"><i class="bi bi-asterisk"></i></small> </label>
                                        <input type="text" class="form-control pubt" name="pub[<?= esc($key);?>][title]" placeholder="Enter title of publication." value="<?= $pub['pub_title'];?>">
                                        <em class="help_block error text-danger" id="pub-${p}-title-error"></em>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label class="nl" for="p_venue">Journal Name: <small class="text-danger"><i class="bi bi-asterisk"></i></small> </label>
                                        <input type="text" class="form-control pubv" name="pub[<?= esc($key);?>][p_venue]" placeholder="Enter name of Journal." value="<?= $pub['pub_venue'];?>">
                                        <em class="help_block error text-danger" id="pub-${p}-p_venue-error"></em>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4 ">
                                        <label class="nl" for="p_afname">First Author: <small class="text-danger"><i class="bi bi-asterisk"></i></small> </label>
                                        <input type="text" name="pub[<?= esc($key);?>][afname]" class="form-control pubAn" placeholder="Enter Initial(s).Surname. of first author." value="<?= $pub['pub_author'];?>">
                                        <em class="help_block error text-danger" id="pub-${p}-afname-error"></em>
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label class="nl" for="p_date">Publication Year: <small class="text-danger"><i class="bi bi-asterisk"></i></small> </label>
                                        <input type="number" name="pub[<?= esc($key);?>][p_date]" placeholder="YYYY" class="pubd form-control"  value="<?= $pub['pub_date'];?>">
                                        <em class="help_block error text-danger" id="pub-${p}-p_date-error"></em>
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label class="nl" for="p_odi">DOI: </label>
                                        <input type="text" name="pub[<?= esc($key);?>][p_odi]" class="form-control pubdoi" placeholder="Enter publication DOI." value="<?= $pub['pub_doi'];?>">
                                        <em class="help_block error text-danger" id="pub-${p}-p_odi-error"></em>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <hr>
                    <div class="row mb-4">
                        <div class="col-md-2 col-2"> <button type="button" id="addpublication" class="form-control btn btn-light"><i class="bi bi-plus-lg"></i>Publication</button></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="UpdatePubs" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Conditions Modal -->
<div class="modal fade" id="editConditionsModal" tabindex="-1" aria-labelledby="editConditionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="editConditionsForm">
                <div class="modal-header">
                    <div class="tittle modal-title text-center mb-0">
                        <h4 class="mb-0 text-center fs-2">Update Conditions</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="section" value="conditions">
                    <input type="hidden" id="encrypted_id" name="d_id" value="<?= $dataset['encrypted_id']; ?>">
                    <div id="condition">
                
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <label class="nl" for="c_allowedcountries">Allowed Countries:</label>
                                <span id="allowedC" class="input-group">
                                    <select name="c_allowedcountries" id="c_allowedcountries" class="form-control c_allowedcountries" multiple="multiple">
                                        <?php if (!empty($conditions['c_countries'])): ?>
                                            <?php $countries = explode(';', $conditions['c_countries']); ?>
                                            <?php foreach ($countries as $country): ?>
                                                <option value="<?= $country; ?>" <?= $country ? 'selected' : ''; ?>><?= $country; ?></option>
                                            <?php endforeach;?>
                                        <?php endif; ?>
                                    </select>
                                </span>
                                <em class="help_block error text-danger" id="c_allowedcountries-error"></em>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="nl" for="c_profituse">Profit Use:</label>
                                <span id="pUse" class="input-group">
                                    <select name="c_profituse" id="c_profituse" class="form-control">
                                        <?php if (!empty($conditions['c_profituse'])): ?>
                                            <option value="<?= $conditions['c_profituse']; ?>" <?= $conditions['c_profituse'] ? 'selected' : ''; ?>><?= $conditions['c_profituse']; ?></option>
                                        <?php endif; ?>
                                    </select>
                                </span>
                                <em class="help_block error text-danger" id="c_profituse-error"></em>
                            </div>
                            <div class="form-group col-md-3 col-sm-3 col-12">
                                <label class="nl" for="c_contact">Recontact:</label>
                                <span id="reCon" class="input-group">
                                    <select name="c_contact" id="c_contact" class="form-control">
                                        <?php if (!empty($conditions['c_reconenct'])): ?>
                                            <option value="<?= $conditions['c_reconenct']; ?>" <?= $conditions['c_reconenct'] ? 'selected' : ''; ?>><?= $conditions['c_reconenct']; ?></option>
                                        <?php endif; ?>
                                    </select>
                                </span>
                                <em class="help_block error text-danger" id="c_contact-error"></em>
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <div class="form-group col-md-6">
                                <label class="nl" for="c_bru">Broad Research Uses:</label>
                                <span id="bru" class="input-group">
                                    <select class="form-control c_bru" id="c_bru" type="text" name="c_bru" multiple="multiple">
                                        <?php if (!empty($conditions['c_broadresearchuse'])): ?>
                                            <?php $brus = explode(';', $conditions['c_broadresearchuse']); ?>
                                            <?php foreach ($brus as $bru): ?>
                                                <option value="<?= $bru; ?>" <?= $bru ? 'selected' : ''; ?>><?= $bru; ?></option>
                                            <?php endforeach;?>
                                        <?php endif; ?>
                                    </select>
                                </span>
                                <em class="help_block error text-danger" id="c_bru-error"></em>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="nl" for="c_cru">Specific Research Uses:</label>
                                <span id="sru" class="input-group">
                                    <select class="form-control c_sru" id="c_sru" name="c_sru" multiple="multiple">
                                        <?php if (!empty($conditions['c_broadresearchuse'])): ?>
                                            <?php $crus = explode(';', $conditions['c_specificresearchuse']); ?>
                                            <?php foreach ($crus as $cru): ?>
                                                <option value="<?= $cru; ?>" <?= $cru ? 'selected' : ''; ?>><?= $cru; ?></option>
                                            <?php endforeach;?>
                                        <?php endif; ?>
                                    </select>
                                </span>
                                <em class="help_block error text-danger" id="c_sru-error"></em>
                            </div>
                        </div>
                    </div>
                </div>             
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id = "UpdateConditions" class="btn btn-primary">Save changes</button>
                </div>
            </form>
    </div>
</div>




</div>
<?= $this->endSection() ?>