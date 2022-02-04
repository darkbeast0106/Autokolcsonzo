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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="<?php echo base_url(); ?>util/custom.css">

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
		<a class="navbar-brand" href="#"><!-- TODO: brand hozzáadása--></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
        <div id="navbarNav" class="collapse navbar-collapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item" id="kezdolap">
					<a class="nav-link" href="<?php echo base_url(); ?>">Kezdőlap</a>
				</li>
				<?php if ($this->session->userdata('user') !== NULL): ?>
					<li class="nav-item" id="auto_felvetele">
						<a class="nav-link" href="<?php echo base_url(); ?>auto/auto_felvetele">Autó felvétele</a>
					</li>
					<li class="nav-item" id="sajat_autoim">
						<a class="nav-link" href="<?php echo base_url(); ?>auto/sajat_autoim">Saját autóim</a>
					</li>
					<li class="nav-item" id="autok_bongeszese">
						<a class="nav-link" href="<?php echo base_url(); ?>auto/autok_bongeszese">Autók böngészése</a>
					</li>
					<li class="nav-item" id="sajat_ajanlataim">
						<a class="nav-link" href="<?php echo base_url(); ?>ajanlat">Saját ajánlataim</a>
					</li>
				<?php else: ?>
				<?php endif; ?>
			</ul>
					<ul class="navbar-nav">
				<?php if ($this->session->userdata('user') !== NULL): ?>
					<li class="nav-item" id="kijelentkezes">
						<a class="nav-link" href="<?php echo base_url(); ?>kijelentkezes">Kijelentkezés</a>
					</li>
				<?php else: ?>
					<li class="nav-item" id="regisztracio">
						<a class="nav-link" href="<?php echo base_url(); ?>regisztracio">Regisztráció</a>
					</li>
					<li class="nav-item" id="bejelentkezes">
						<a class="nav-link" href="<?php echo base_url(); ?>bejelentkezes">Bejelenkezés</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
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
