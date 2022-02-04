<div class="jumbotron">
	<h1>Köszöntelek az autókölcsönzőben</h1>
	<p>Kölcsönzéshez és további autók meghirdetéséhez kérlek regisztrálj, vagy jelentkezz be.</p>
</div>
<div class="row">
	<?php foreach ($autok as $auto) : ?>
		<div class="col-lg-3 col-md-4 col-sm-6 col-12 d-flex">
			<div class="card flex-fill">
				<div class="img-container card-header">
					<img class="card-img-top" src="<?php echo base_url() . 'uploads/' . $auto['kep']; ?>" alt="Autó képe">
				</div>
				<div class="card-body">
					<h5 class="card-title"><?php echo $auto['marka'] . ' - ' . $auto['modell'] ?></h5>
					<p class="card-text"><?php echo strlen($auto['leiras']) > 75 ? substr($auto['leiras'], 0, 75) . "..." : $auto['leiras']  ?></p>
				</div>
				<div class="card-footer">
					<p><?php echo $auto['eladasi_ar'] ?> Ft</p>
					<button onclick="auto_reszletek(<?php echo $auto['id'] ?>)" class="btn btn-success" style="width: 100%;">Részletek</button>
				</div>
			</div>
		</div>

	<?php endforeach; ?>
</div>

