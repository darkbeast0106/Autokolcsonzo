<div class="row">
	<?php foreach ($ajanlatok as $ajanlat) : ?>
		<div class="col-lg-6 d-flex">
			<div class="card flex-fill">
				<div class="card-header">
					<h4 class="card-title"><?php echo $ajanlat['auto_nev'] ?></h4>
				</div>
				<div class="card-body table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<th>Ajánlott ár</th>
								<td><?php echo number_format($ajanlat['ar'], 0, ',', ' ') ?> Ft</td>
							</tr>
							<tr>
								<th>E-mail</th>
								<td><?php echo $ajanlat['ajanlat_tevo_adatok']['email'] ?></td>
							</tr>
							<tr>
								<th>Tel</th>
								<td><?php echo $ajanlat['ajanlat_tevo_adatok']['tel'] ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="card-footer">
					<button onclick="auto_reszletek(<?php echo $ajanlat['auto_id'] ?>)" class="btn btn-success" style="width: 100%;">Autó részletei</button>
					<button onclick="ajanlat_elfogadasa(<?php echo $ajanlat['id'] ?>)" class="btn btn-warning" style="width: 100%;">Ajánlat elfogadása</button>
					<button onclick="ajanlat_elutasitasa(<?php echo $ajanlat['id'] ?>)" class="btn btn-danger" style="width: 100%;">Ajánlat elutasítása</button>
				</div>
			</div>
		</div>

	<?php endforeach; ?>
</div>

<script>
	function ajanlat_elutasitasa(id) {
		if(confirm("Biztos, hogy törölni szeretné a kiválasztott ajánlatot?")){
			location = "<?php echo base_url() . "ajanlat/ajanlat_elutasitasa/" ?>" +id;
		}
	}
	function ajanlat_elfogadasa(id) {
		if(confirm("Biztos, hogy törölni szeretné a kiválasztott ajánlatot?")){
			location = "<?php echo base_url() . "ajanlat/ajanlat_elfogadasa/" ?>" +id;
		}
	}

</script>
