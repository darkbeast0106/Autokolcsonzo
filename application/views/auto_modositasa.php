<h2 class="mt-3">Autó módosítása</h2>
<form action="<?php echo base_url() . 'auto_modositasa/' . $auto['id']; ?>" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label for="marka">Márka:</label>
		<input type="text" class="form-control" id="marka" placeholder="Márka" name="marka" required <?php if ($this->session->flashdata('last_request') !== null) : ?> value="<?php echo ($this->session->flashdata('last_request')['marka']) ?>" <?php else : ?> value="<?php echo $auto['marka'] ?>" <?php endif; ?>>
	</div>
	<div class="form-group">
		<label for="modell">Modell:</label>
		<input type="text" class="form-control" id="modell" placeholder="Modell" name="modell" required <?php if ($this->session->flashdata('last_request') !== null) : ?> value="<?php echo ($this->session->flashdata('last_request')['modell']) ?>" <?php else : ?> value="<?php echo $auto['modell'] ?>" <?php endif; ?>>
	</div>
	<div class="form-group">
		<label for="uzemanyag">Üzemanyag típusa:</label>
		<input type="text" class="form-control" id="uzemanyag" placeholder="Üzemanyag típusa" name="uzemanyag" required <?php if ($this->session->flashdata('last_request') !== null) : ?> value="<?php echo ($this->session->flashdata('last_request')['uzemanyag']) ?>" <?php else : ?> value="<?php echo $auto['uzemanyag'] ?>" <?php endif; ?>>
	</div>
	<div class="form-group">
		<label for="gyartasi_ev">Gyártási év:</label>
		<input type="text" class="form-control" id="gyartasi_ev" placeholder="Gyártási év" name="gyartasi_ev" required <?php if ($this->session->flashdata('last_request') !== null) : ?> value="<?php echo ($this->session->flashdata('last_request')['gyartasi_ev']) ?>" <?php else : ?> value="<?php echo $auto['gyartasi_ev'] ?>" <?php endif; ?>>
	</div>
	<div class="form-group">
		<label for="eladasi_ar">Eladási ár:</label>
		<input type="text" class="form-control" id="eladasi_ar" placeholder="Eladási ár" name="eladasi_ar" required <?php if ($this->session->flashdata('last_request') !== null) : ?> value="<?php echo ($this->session->flashdata('last_request')['eladasi_ar']) ?>" <?php else : ?> value="<?php echo $auto['eladasi_ar'] ?>" <?php endif; ?>>
	</div>
	<div class="form-group">
		<label for="leiras">Leírás:</label>
		<textarea class="form-control" id="leiras" name="leiras" rows="3"><?php if ($this->session->flashdata('last_request') !== null) : ?><?php echo ($this->session->flashdata('last_request')['leiras']) ?><?php else : ?><?php echo $auto['leiras'] ?><?php endif; ?></textarea>
	</div>
	<div class="form-group">
		<label for="kep">Autó képe:</label>
		<input accept=".jpg,.jpeg,.png,.bmp,.gif" type="file" class="form-control-file" id="kep" name="kep">
	</div>
	<div class="form-group">
		<label for="tovabbi_kepek">További képek az autóról:</label>
		<input accept=".jpg,.jpeg,.png,.bmp,.gif" type="file" class="form-control-file" id="tovabbi_kepek" name="tovabbi_kepek[]" multiple>
	</div>
	<button type="submit" class="btn btn-primary">Módosítás</button>
</form>
