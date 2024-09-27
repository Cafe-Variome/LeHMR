$(document).ready(function() {
    $('#msform').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting the traditional way
        if ($("#userinfobody").find(".table-danger").length > 0 ||$("#datainfobody").find(".table-danger").length > 0 || $("#publicationbody").find(".table-danger").length > 0 || $("#personbody").find(".table-danger").length > 0 ) {
            // Trigger SweetAlert if there are errors
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill all the mendotry fields to add dataset.',
                confirmButtonText: 'OK'
            });
        }else{

            // Serialize the form data
            var formData = $(this).serialize();
            // Send the data via AJAX
            $.ajax({
                url: base_url + "add", // Adjust the URL to match your controller
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Your data has been successfully submitted.',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: 'Add More',
                            cancelButtonText: 'Go to Home'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Refresh form and keep user information
                                resetForm(true);
                            } else {
                                // Redirect to the home page
                                window.location.href = base_url;
                            }
                        });
                    } else {
                        // Handle error case
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function() {
                    // Show error message
                    Swal.fire('Error', 'There was a problem submitting your data.', 'error');
                }
            });

        }

    });
    function resetForm(keepUserInfo) {
        if (keepUserInfo) {
            const userInfo = {
                fname: $('#u_fname').val(),
                lname: $('#u_lname').val(),
                email: $('#u_email').val(),
                role: $('#u_role').val()
            };
            
            location.reload(); // Reset the form
            
            // Repopulate the user information fields
            $('#u_fname').val(userInfo.fname);
            $('#u_lname').val(userInfo.lname);
            $('#u_email').val(userInfo.email);
            $('#u_role').val(userInfo.role);
        } else {
            window.location.href = base_url; // Just reset the form completely
        }
    }
});
