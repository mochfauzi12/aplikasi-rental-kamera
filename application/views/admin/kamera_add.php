

<div class="page-header">
	<h3>Add Kamera</h3>
</div>

<form action="<?php echo base_url() . 'admin/kamera_add_act' ?>" method="post"> 
	<div class="form-group">
		<label>Merk Kamera</label>
		<input type="text" name="merk" class="form-control">
		<?php echo form_error('merk'); ?>
	</div>
	<div class="form-group">
		<label>No. Seri Kamera</label>
		<input type="text" name="plat" class="form-control">
	</div>
	<div class="form-group">
		<label>Warna</label>
		<input type="text" name="warna" class="form-control">
	</div>
	
	<div class="form-group">
		<label>Status Kamera</label>
		<select name="status" class="form-control">
			<option value="1">Tersedia</option>
			<option value="2">Sedang Di Rental</option>
		</select>
		<?php echo form_error('status'); ?>
	</div>	
	<div class="form-group">
		<input type="submit" value="Simpan" class="btn btn-primary">
	</div>
</div>
</form>