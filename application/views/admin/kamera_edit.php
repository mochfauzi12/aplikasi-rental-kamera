<div class="page-header">
	<h3>Edit Mobil</h3>
</div>


<?php foreach ($kamera as $m) { ?>
<form action="<?php echo base_url() . 'admin/kamera_update' ?>" method="post"> 
	<div class="form-group">
		<label>Merk Kamera SKC</label>
		<input type="hidden" name="id" value="<?php echo $m->kamera_id; ?>">
		<input class="form-control" type="text" name="merk" value="<?php echo $m->kamera_merk; ?>">
		<?php echo form_error('merk'); ?>
	</div>

	<div class="form-group">
		<label>No.Seri Kendaran</label>
		<input class="form-control" type="text" name="plat" value="<?php echo $m->kamera_plat; ?>">
	</div>

	<div class="form-group">
		<label>Warna</label>
		<input class="form-control" type="text" name="warna" value="<?php echo $m->kamera_warna; ?>">
	</div>

	

	<div class="form-group">
		<label>Status Kamera</label>
		<select name="status" class="form-control">
			<option <?php if ($m->kamera_status == "1") {
											echo "selected='selected'";
										}
										echo $m->kamera_id ?> value="1">Tersedia</option>
			<option <?php if ($m->kamera_status == "2") {
											echo "selected='selected'";
										}
										echo $m->kamera_id ?> value="2">Sedang Di Rental</option>
		</select>	
		<?php echo form_error('status'); ?>
	</div>	

	<div class="form-group">
		<input type="submit" value="Simpan" class="btn btn-primary">
	</div>	
</form>
<?php 
} ?>