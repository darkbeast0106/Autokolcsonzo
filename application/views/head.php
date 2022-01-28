<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autókölcsönző</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <?php if (isset($oldal)) : ?>
        <script>
            $(function() {
                $('#<?php echo $oldal; ?>').addClass('active');
            });
        </script>
    <?php endif; ?>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item" id="kezdolap">
                <a class="nav-link" href="<?php echo base_url(); ?>">Kezdőlap</a>
            </li>
            <li class="nav-item" id="regisztracio">
                <a class="nav-link" href="<?php echo base_url(); ?>regisztracio">Regisztráció</a>
            </li>
            <li class="nav-item" id="bejelentkezes">
                <a class="nav-link" href="<?php echo base_url(); ?>bejelentkezes">Bejelenkezés</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <?php if ($this->session->userdata('success') !== NULL) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->userdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->userdata('error') !== NULL) : ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->userdata('error'); ?>
            </div>
        <?php endif; ?>