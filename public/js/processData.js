$(function(){
    $(document).on('click', '.delete-dataset', function (e) {
        e.preventDefault();
        const datasetId = $(this).data('id');
        const row = $(this).closest('tr');
    
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + 'delete',
                    type: 'POST',
                    data: { d_id: datasetId },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Deleted!', 'Your dataset has been deleted.', 'success');
                            row.remove();
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error!', 'Failed to delete the dataset.', 'error');
                    }
                });
            }
        });
    });
    
    $(document).on('click', '.archive-dataset', function (e) {
        e.preventDefault();
        const datasetId = $(this).data('id');
        const row = $(this).closest('tr');
    
        Swal.fire({
            title: 'Are you sure?',
            text: "You can restore this dataset later!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, archive it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url+'archive',
                    type: 'POST',
                    data: { d_id: datasetId },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Archived!', 'Your dataset has been archived.', 'success');
                            row.remove();
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error!', 'Failed to archive the dataset.', 'error');
                    }
                });
            }
        });
    });
    
    $(document).on('click', '.restore-dataset', function (e) {
        e.preventDefault();
        const datasetId = $(this).data('id');
        const row = $(this).closest('tr');
    
        Swal.fire({
            title: 'Restore Dataset?',
            text: "This will move the dataset back to active!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + 'restore',
                    type: 'POST',
                    data: { d_id: datasetId },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Restored!', 'Your dataset has been restored.', 'success');
                            row.remove();
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error!', 'Failed to restore the dataset.', 'error');
                    }
                });
            }
        });
    });

    $('#requestAccessForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: base_url + 'viewdata/requestAccess',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    Swal.fire('Success!', response.message, 'success');
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error!', 'An unexpected error occurred.', 'error');
            }
        });
    });
    $(document).on('click', '.view-btn', function () {
        var datasetId = $(this).data('id');
        
        // Perform an AJAX request to fetch the dataset details
        $.ajax({
            url: base_url + '/viewdata/getDatasetDetails',
            method: 'POST',
            data: { id: datasetId },
            success: function (response) {
                if (response.success) {
                    // Populate Dataset Information
                    $('#datasetTitle').text(response.data.d_title);
                    $('#datasetAbstract').text(response.data.d_abstract);
                    $('#researchStudy').text(response.data.d_researchstudy);
                    $('#dataTypes').text(response.data.d_datatypes);
                    $('#ethnicities').text(response.data.d_ethnicities);
                    $('#funders').text(response.data.d_funders);
                    $('#geographies').text(response.data.d_geographies);
                    $('#keywords').text(response.data.d_keywords);
                    $('#ageRange').text(response.data.d_agerange);
                    $('#studySize').text(response.data.d_studysize);
                    $('#dataController').text(response.data.d_controler);
                    $('#accessRights').text(response.data.d_arights);
                    $('#legalJurisdiction').text(response.data.d_legaljurisdiction);
                    $('#organisation').text(response.data.d_organisation);
                    $('#contactPoint').text(response.data.d_conpoint);
                    $('#hdrConsent').text(response.data.d_hdrconsent == 1 ? 'Yes' : 'No');
    
                    // Populate Publications
                    // $('#publicationsSection').empty();
                    response.data.publications.forEach(function (publication, index) {
                        var publicationCard = $('#publicationTemplate').clone().removeAttr('id').show();
                        publicationCard.find('.publication-number').text(index + 1);
                        publicationCard.find('.publication-title').text(publication.pub_title);
                        publicationCard.find('.publication-venue').text(publication.pub_venue);
                        publicationCard.find('.publication-author').text(publication.pub_author);
                        publicationCard.find('.publication-year').text(publication.pub_date);
                        publicationCard.find('.publication-doi').text(publication.pub_doi);
                        $('#publicationsSection').append(publicationCard);
                    });
    
                    // Populate Researchers
                    // $('#researchersSection').empty();
                    response.data.researchers.forEach(function (researcher, index) {
                        var researcherCard = $('#researcherTemplate').clone().removeAttr('id').show();
                        researcherCard.find('.researcher-number').text(index + 1);
                        researcherCard.find('.researcher-name').text(researcher.p_firstname + ' ' + researcher.p_surname);
                        researcherCard.find('.researcher-title').text(researcher.p_title);
                        researcherCard.find('.researcher-email').text(researcher.p_email);
                        researcherCard.find('.researcher-affiliations').text(researcher.p_affiliations);
                        $('#researchersSection').append(researcherCard);
                    });
    
                    // Populate Conditions
                    $('#allowedCountries').text(response.data.conditions.c_countries);
                    $('#profitUse').text(response.data.conditions.c_profituse);
                    $('#broadResearchUse').text(response.data.conditions.c_broadresearchuse);
                    $('#specificResearchUse').text(response.data.conditions.c_specificresearchuse);
                    $('#recontact').text(response.data.conditions.c_reconenct);
    
                    // Show the modal
                    $('#viewDatasetModal').modal('show');
                } else {
                    swal("Error", "Failed to load dataset details.", "error");
                }
            },
            error: function () {
                swal("Error", "An error occurred. Please try again.", "error");
            }
        });
    });
    
});
