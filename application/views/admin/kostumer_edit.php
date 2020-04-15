<div class="page-header">
	<h3>Edit Kamera</h3>
</div>


<?php foreach ($kostumer as $k) { ?>
<form action="<?php echo base_url() . 'admin/kostumer_update' ?>" method="post"> 
	<div class="form-group">
		<label>Nama Kostumer</label>
		<input type="text" name="nama" value="<?php echo $k->kostumer_nama; ?>"class="form-control">
		<input type="hidden" name="id" value="<?php echo $k->kostumer_id; ?>" class="form-control">

		<?php echo form_error('nama'); ?>
	</div>

	<div class="form-group">
		<label>Alamat</label>
		<textarea name="alamat" class="form-control"><?php echo $k->kostumer_alamat; ?> </textarea>
	</div>

	<div class="form-group">
		<label>Jenis Kelamin</label>
		<select name="jk" class="form-control">
			<option value="L">Laki-laki</option>
			<option value="P">Perempuan</option>
		</select>	
	</div>

	<div class="form-group">
		<label>HP</label>
		<input type="number" name="hp" value="<?php echo $k->kostumer_hp; ?>" class="form-control">																																				
	</div>

	

	<div class="form-group">
		<label>No. KTP</label>
		<input type="text" name="ktp" value="<?php echo $k->kostumer_ktp; ?> "class="form-control"><br/>

	<div class="form-group">
		<input type="submit" value="Simpan" class="btn btn-primary">
	</div>	
</form>
<?php 
} ?>