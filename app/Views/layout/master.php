<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leicester Health Metadata Resource</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('public/images/favicons/favicon.ico') ?>">

    <!-- STYLES -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudfare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/autosize.js/3.0.15/autosize.min.js'></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Jquery Validation Plugin -->
    <script src="<?php echo base_url('public/js/jquery-validation-plugin/jquery.validate.js') ?>?v=<?php echo rand()?>"></script>   
    <!-- Select 2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Swal Files -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- DataTable -->
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-html5-2.4.2/r-2.5.0/datatables.min.css" rel="stylesheet"> 
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"> 
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"> 
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-html5-2.4.2/r-2.5.0/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

    
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/nav.css') ?>?v=<?php echo rand()?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/site.css') ?>?v=<?php echo rand()?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/form.css') ?>?v=<?php echo rand()?>">


    <!-- JS Files -->
    <script>var base_url = '<?php echo base_url() ?>';</script>
    <script src="<?php echo base_url('public/js/common.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/getdata.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/form.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/tags.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/summary.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/formValidation.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/formSubmit.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/processData.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/editData.js') ?>?v=<?php echo rand()?>"></script>

    <!-- Poppin fonts -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- XLSX Download -->
    <script type="text/javascript" src="//unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

</head>
<body>

<!-- HEADER: MENU + HEROE SECTION -->
<header>

<?= $this->include('temp/nav') ?>
<div class="row text-center"><div class="col-5"><?= $this->include('temp/alerts') ?></div></div>
</header>

<!-- CONTENT -->

<section id="mainSection" class="h-100">

<?= $this->renderSection('content') ?>

</section>
    <script>
        $(document).ready(function() {
            <?php $session = session(); ?>
            <?php if ($session->get('success') || $session->get('danger') || $session->get('warning') || $session->get('info')) : ?>
                <?php if ($session->get('success')) : ?>
                    console.log("I am here")
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '<?php echo $session->get('success')?>',
                        showConfirmButton: false,
                        timer: 1500
                    })
                <?php endif; ?>
            <?php endif; ?>
        });
    </script>


</body>
</html>
