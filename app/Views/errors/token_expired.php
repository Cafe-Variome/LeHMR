<?php

/**
 * @author Umar Riaz
 * Created at 21/08/2024
 */
?>

<?= $this->extend('layout/master') ?>
<?= $this->section('content') ?>
<div class="MidContainer mx-auto">
    <script>
        Swal.fire({
            title: 'Notice',
            text: '<?= $message; ?>',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = base_url; // Redirect to home or another appropriate page
        });
    </script>
</div>
<?= $this->endSection() ?>