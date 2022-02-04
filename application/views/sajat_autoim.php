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
					<a href="<?php echo base_url(). 'auto/auto_ajanlatai/'.$auto['id'] ?>" class="btn btn-warning" style="width: 100%;">Autó ajánlatai</a>
					<a href="<?php echo base_url(). 'auto/auto_modositasa/'.$auto['id'] ?>" class="btn btn-info" style="width: 100%;">Autó módosítása</a>
					<button onclick="auto_torlese(<?php echo $auto['id'] ?>)" class="btn btn-danger" style="width: 100%;">Törlés</button>
				</div>
			</div>
		</div>

	<?php endforeach; ?>
</div>

<script>
	function auto_torlese(id) {
		if(confirm("Biztos, hogy törölni szeretné a kiválasztott autót?")){
			location = "<?php echo base_url() . "auto/auto_torlese/" ?>" +id;
		}
	}

</script>
