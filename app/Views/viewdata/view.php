<?php

/**
 * @author Umar Riaz
 * Created at 21/08/2024
 */
?>

<?= $this->extend('layout/master') ?>
<?= $this->section('content') ?>
<div class="MidContainer mx-auto">
    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="mb-0">Active Datasets</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover" id="activedata">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name of Dataset</th>
                            <th>Abstract</th>
                            <th class="text-center">Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($activeDatasets)): ?>
                            <?php $counter = 1; ?>
                            <?php foreach ($activeDatasets as $dataset): ?>
                                <tr>
                                    <td><?= $counter++; ?></td>
                                    <td><?= esc($dataset['d_title']); ?></td>
                                    <td><?= esc($dataset['d_abstract']); ?></td>
                                    <td class="text-center">
                                        <a href="#" data-id="<?=esc($dataset['encrypted_id']);?>" class="btn btn-primary btn-sm view-btn">
                                            <i class="bi bi-eye"></i> <!-- View Icon -->
                                        </a>
                                        <a href="<?= base_url('update/' . esc($dataset['encrypted_id'])); ?>" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> <!-- Update Icon -->
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm delete-dataset" data-id="<?= esc($dataset['encrypted_id']); ?>">
                                            <i class="bi bi-trash"></i> <!-- Delete Icon -->
                                        </a>
                                        <a href="#" class="btn btn-secondary btn-sm archive-dataset" data-id="<?= esc($dataset['encrypted_id']); ?>">
                                            <i class="bi bi-archive"></i> <!-- Archive Icon -->
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center">No active datasets found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Pagination for Active Datasets -->
                <?= $activePaginationLinks ?? '' ?>
            </div>
        </div>

        <div class="card mb-4">
            <a class="btn" data-bs-toggle="collapse" href="#archivedata"  aria-expanded="false" aria-controls="archivedata">
                <div class="card-header"><h4 class="mb-0">Archived Datasets</h4></div>
            </a>
            <div class="card mb-4 collapse" id="archivedata">
                <div class="card-body">
                    <table class="table table-striped table-hover" id="archivedata">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name of Dataset</th>
                                <th>Abstract</th>
                                <th class="text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($archivedDatasets)): ?>
                                <?php $counter = 1; ?>
                                <?php foreach ($archivedDatasets as $dataset): ?>
                                    <tr>
                                        <td><?= $counter++; ?></td>
                                        <td><?= esc($dataset['d_title']); ?></td>
                                        <td><?= esc($dataset['d_abstract']); ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url('dataset/view/' . esc($dataset['encrypted_id'])); ?>" class="btn btn-primary btn-sm">
                                                <i class="bi bi-eye"></i> <!-- View Icon -->
                                            </a>
                                            <a href="#" class="btn btn-success btn-sm restore-dataset" data-id="<?= esc($dataset['encrypted_id']); ?>">
                                                <i class="bi bi-arrow-counterclockwise"></i> <!-- Restore Icon -->
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center">No archived datasets found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination for Archived Datasets -->
                    <?= $archivedPaginationLinks ?? '' ?>
                </div>
            </div>

        </div>
    </div>


<!-- View Dataset Modal -->
<div class="modal fade" id="viewDatasetModal" tabindex="-1" aria-labelledby="viewDatasetModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="viewDatasetModalLabel">Dataset Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <!-- Dataset Information Section -->
        <div class="card mb-3">
          <div class="card-header bg-secondary text-white">
            Dataset Information
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <tbody>
                <!-- Include all dataset fields here -->
                <tr>
                  <th>Title:</th>
                  <td id="datasetTitle"></td>
                </tr>
                <tr>
                  <th>Abstract:</th>
                  <td id="datasetAbstract"></td>
                </tr>
                <tr>
                  <th>Research Study:</th>
                  <td id="researchStudy"></td>
                </tr>
                <tr>
                  <th>Data Types:</th>
                  <td id="dataTypes"></td>
                </tr>
                <tr>
                  <th>Ethnicities:</th>
                  <td id="ethnicities"></td>
                </tr>
                <tr>
                  <th>Funders:</th>
                  <td id="funders"></td>
                </tr>
                <tr>
                  <th>Geographies:</th>
                  <td id="geographies"></td>
                </tr>
                <tr>
                  <th>Keywords:</th>
                  <td id="keywords"></td>
                </tr>
                <tr>
                  <th>Age Range:</th>
                  <td id="ageRange"></td>
                </tr>
                <tr>
                  <th>Study Size:</th>
                  <td id="studySize"></td>
                </tr>
                <tr>
                  <th>Data Controller:</th>
                  <td id="dataController"></td>
                </tr>
                <tr>
                  <th>Access Rights:</th>
                  <td id="accessRights"></td>
                </tr>
                <tr>
                  <th>Legal Jurisdiction:</th>
                  <td id="legalJurisdiction"></td>
                </tr>
                <tr>
                  <th>Organisation:</th>
                  <td id="organisation"></td>
                </tr>
                <tr>
                  <th>Contact Point:</th>
                  <td id="contactPoint"></td>
                </tr>
                <tr>
                  <th>HDR Consent:</th>
                  <td id="hdrConsent"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Publications Section -->
        <div class="card mb-3">
          <div class="card-header bg-info text-white" data-bs-toggle="collapse" href="#publicationsCollapse" role="button" aria-expanded="false" aria-controls="publicationsCollapse">
            Publications
          </div>
          <div id="publicationsCollapse" class="collapse">
            <div id="publicationsSection">
              <!-- Each publication card will be added here dynamically -->
              <div class="card mb-3" id="publicationTemplate" style="display:none;">
                <div class="card-header">
                  Publication <span class="publication-number"></span>: <span class="publication-title"></span>
                </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th>Journal Name:</th>
                        <td class="publication-venue"></td>
                      </tr>
                      <tr>
                        <th>First Author:</th>
                        <td class="publication-author"></td>
                      </tr>
                      <tr>
                        <th>Publication Year:</th>
                        <td class="publication-year"></td>
                      </tr>
                      <tr>
                        <th>DOI:</th>
                        <td class="publication-doi"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Researchers Section -->
        <div class="card mb-3">
          <div class="card-header bg-success text-white" data-bs-toggle="collapse" href="#researchersCollapse" role="button" aria-expanded="false" aria-controls="researchersCollapse">
            Researchers
          </div>
          <div id="researchersCollapse" class="collapse">
            <div id="researchersSection">
              <!-- Each researcher card will be added here dynamically -->
              <div class="card mb-3" id="researcherTemplate" style="display:none;">
                <div class="card-header">
                  Researcher <span class="researcher-number"></span>: <span class="researcher-name"></span>
                </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th>Title:</th>
                        <td class="researcher-title"></td>
                      </tr>
                      <tr>
                        <th>Email:</th>
                        <td class="researcher-email"></td>
                      </tr>
                      <tr>
                        <th>Affiliations:</th>
                        <td class="researcher-affiliations"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Conditions Section -->
        <div class="card">
          <div class="card-header bg-warning text-dark" data-bs-toggle="collapse" href="#conditionsCollapse" role="button" aria-expanded="false" aria-controls="conditionsCollapse">
            Conditions
          </div>
          <div id="conditionsCollapse" class="collapse">
            <div class="card-body">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th>Allowed Countries:</th>
                    <td id="allowedCountries"></td>
                  </tr>
                  <tr>
                    <th>Profit Use:</th>
                    <td id="profitUse"></td>
                  </tr>
                  <tr>
                    <th>Broad Research Use:</th>
                    <td id="broadResearchUse"></td>
                  </tr>
                  <tr>
                    <th>Specific Research Use:</th>
                    <td id="specificResearchUse"></td>
                  </tr>
                  <tr>
                    <th>Recontact:</th>
                    <td id="recontact"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






</div>
<?= $this->endSection() ?>