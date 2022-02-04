<div class="row">
	<?php foreach ($ajanlatok as $ajanlat) : ?>
		<div class="col-lg-3 col-md-4 col-sm-6 col-12 d-flex">
			<div class="card flex-fill">
				<div class="card-header">
					<h4 class="card-title"><?php echo $ajanlat['auto_nev'] ?></h4>
				</div>
				<div class="card-body">
					<p><?php echo number_format($ajanlat['ar'], 0, ',', ' ') ?> Ft</p>
				</div>
				<div class="card-footer">
					<button onclick="auto_reszletek(<?php echo $ajanlat['auto_id'] ?>)" class="btn btn-success" style="width: 100%;">Autó részletei</button>
					<button onclick="ajanlat_torlese(<?php echo $ajanlat['id'] ?>)" class="btn btn-danger" style="width: 100%;">Törlés</button>
				</div>
			</div>
		</div>

	<?php endforeach; ?>
</div>

<script>
	function ajanlat_torlese(id) {
		if(confirm("Biztos, hogy törölni szeretné a kiválasztott ajánlatot?")){
			location = "<?php echo base_url() . "ajanlat/ajanlat_torlese/" ?>" +id;
		}
	}

</script>
