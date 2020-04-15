<div class="page-header">
	<h3>Transaksi Selesai</h3>
</div>

<?php foreach ($transaksi as $t) { ?>
<form action="<?php echo base_url() . 'admin/transaksi_selesai_act' ?>" method="post"> 
	<input type="hidden" name="id" value="<?php echo $t->transaksi_id ?>">		
	<input type="hidden" name="kamera" value="<?php echo $t->transaksi_kamera ?>">		
	<input type="hidden" name="tgl_kembali" value="<?php echo $t->transaksi_tgl_kembali ?>">		
	<input type="hidden" name="denda" value="<?php echo $t->transaksi_denda ?>">

	<div class="form-group">
		<label>Kostumer</label>
		<select class="form-control" name="kostumer" disabled>
			<option value="">-Pilih Kostumer-</option>
			<?php foreach ($kostumer as $k) { ?>
			<option <?php if ($t->transaksi_kostumer == $k->kostumer_id) {
											echo "selected='selected'";
										} ?> value="<?php echo $k->kostumer_id; ?>"><?php echo $k->kostumer_nama; ?></option>
			<?php 
	} ?>
		</select>		
	</div>		

	<div class="form-group">
		<label>Kamera</label>
		<select class="form-control" name="kamera" disabled>
			<option value="">-Pilih Kamera-</option>
			<?php foreach ($kamera as $m) { ?>
			<option <?php if ($t->transaksi_kamera == $m->kamera_id) {
											echo "selected='selected'";
										} ?> value="<?php echo $m->kamera_id; ?>"><?php echo $m->kamera_merk; ?></option>
											
										
			<?php 
	} ?>
		</select>		
	</div>

	<div class="form-group">
		<label>Tanggal Pinjam</label>
		<input class="form-control" type="date" name="tgl_pinjam" value="<?php echo $t->transaksi_tgl_pinjam ?>" disabled>	
	</div>

	<div class="form-group">
		<label>Tanggal Kembali</label>
		<input class="form-control" type="date" name="tgl_kembali" value="<?php echo $t->transaksi_tgl_kembali ?>" disabled>	
	</div>

	<div class="form-group">
		<label>Harga</label>
		<input class="form-control" type="number" name="harga" value="<?php echo $t->transaksi_harga ?>" disabled>
	</div>

	<div class="form-group">
		<label>Harga Denda / Hari</label>
		<input class="form-control" type="text" name="denda" value="<?php echo $t->transaksi_denda ?>" disabled>	
	</div>

	<div class="form-group">
		<label>Tanggal Dikembalikan Oleh Kostumer</label>
		<input class="form-control" type="date" name="tgl_dikembalikan">	
		<?php echo form_error('tgl_dikembalikan'); ?>
	</div>

	<div class="form-group">
		<input type="submit" value="Simpan" class="btn btn-primary btn-sm">
	</div>
</form>
<?php 
} ?>