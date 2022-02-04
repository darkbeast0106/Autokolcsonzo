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
					<button onclick="auto_ajanlat(<?php echo $auto['id'] ?>, <?php echo $auto['eladasi_ar'] ?>)" class="btn btn-warning" style="width: 100%;">Ajánlat tétel</button>
				</div>
			</div>
		</div>

	<?php endforeach; ?>
</div>

<div class="modal" tabindex="-1" role="dialog" id="ajanlat_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			
			<form action="<?php echo base_url() ?>/ajanlat/ajanlat_tetel" method="POST">
				<div class="modal-header">
					<h5 class="modal-title">Ajánlat tétel</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="auto_id" id="ajanlat_auto_id">
					<input class="form-control" type="number" name="ar" id="ajanlat_ar">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-warning">Ajánlat tétel</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Bezárás</button>
				</div>
			</form>

		</div>
	</div>
</div>


<script>
	function auto_ajanlat(id, ar) {
		$("#ajanlat_auto_id").val(id);
		$("#ajanlat_ar").val(ar);
		$("#ajanlat_modal").modal('show');
	}
</script>
