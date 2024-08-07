<!DOCTYPE html>
<html lang="en">

<?= $this->include('layout/header'); ?>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <?= $this->include('layout/navbar'); ?>
        <?= $this->include('layout/sidebar'); ?>
        <?= $this->renderSection('content'); ?>
        <?= $this->include('layout/footer'); ?>

    </div>
    <!-- ./wrapper -->
</body>

<?= $this->include('layout/js'); ?>

</html>