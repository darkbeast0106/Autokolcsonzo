<div class="modal" tabindex="-1" role="dialog" id="reszletek_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Részletek</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<img class="col-12" id="reszletek_kep" src="<?php echo base_url() . 'uploads/ford_focus_2022_01_28_18_56_26_1.jpg' ?>" alt="Autó képe">
				</div>
				<h5>Autó adatai</h5>
				<table class="table">
					<tbody>
						<tr>
							<th>Gyártó</th>
							<td id="reszletek_gyarto">Ford</td>
						</tr>
						<tr>
							<th>Modell</th>
							<td id="reszletek_modell">Focus</td>
						</tr>
						<tr>
							<th>Üzemanyag típúsa</th>
							<td id="reszletek_uzemanyag">benzin</td>
						</tr>
						<tr>
							<th>Gyártási év</th>
							<td id="reszletek_ev">2020</td>
						</tr>
						<tr>
							<th>Eladási ár</th>
							<td id="reszletek_ar">3.000.000 Ft</td>
						</tr>
					</tbody>
				</table>

				<h6>Leírás</h6>
				<p id="reszletek_leiras">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt expedita recusandae consequatur vitae totam illum repudiandae quaerat ea, beatae animi natus asperiores nobis nesciunt aliquam cupiditate dolores illo voluptates in!</p>

				<h5>Hirdető adatai</h5>
				<table class="table">
					<tbody>
						<tr>
							<th>E-mail</th>
							<td id="reszletek_email">teszt@example.com</td>
						</tr>
						<tr>
							<th>Tel</th>
							<td id="reszletek_tel">+36301234567</td>
						</tr>

					</tbody>
				</table>

				<h6>További képek</h6>
				<div class="row" id="reszletek_tovabbi_kepek">
					<img src="<?php echo base_url() . 'uploads/ford_focus_2022_01_28_18_56_26_1.jpg' ?>" alt="autó képe" class="col-12">
					<img src="<?php echo base_url() . 'uploads/ford_focus_2022_01_28_18_56_26_1.jpg' ?>" alt="autó képe" class="col-12">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Bezárás</button>
			</div>
		</div>
	</div>
</div>

<script>
	function auto_reszletek(id) {
		let url = "<?php echo base_url() ?>api/auto/" + id;
		$.get(
			url,
			function(data, textStatus, jqXHR) {
				if (textStatus == "success") {
					$("#reszletek_modal").modal('show');
					$("#reszletek_gyarto").html(data.marka);
					$("#reszletek_modell").html(data.modell);
					$("#reszletek_uzemanyag").html(data.uzemanyag);
					$("#reszletek_ev").html(data.gyartasi_ev);
					$("#reszletek_ar").html(Intl.NumberFormat('hu-HU').format(data.eladasi_ar) + " Ft");
					$("#reszletek_email").html(data.hirdeto.email);
					$("#reszletek_tel").html(data.hirdeto.tel);

					let uploads_url = "<?php echo base_url() ?>uploads/";
					let kepek_html = "";

					$("#reszletek_kep").attr('src', uploads_url+data.kep);

					$.each(data.tovabbi_kepek, function(indexInArray, valueOfElement) {
						kepek_html += '<img src="' + uploads_url + valueOfElement.kep + '" alt="autó képe" class="col-12">';
					});

					$("#reszletek_tovabbi_kepek").html(kepek_html);
				}
			},
			"json"
		);
	}
</script>
