<div class="page-header">
	<h3>Data Sewa Kamera SKC</h3>
</div>


<a href="<?php echo base_url() . 'admin/kamera_add'; ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Masukkan daftar Kamera</a>
<br/><br/>
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="table-datatable">
	<thead>
		<tr>
			<th>No</th>
			<th>Merk Kamera</th>
			<th>No Seri Kamera</th>
			<th>Warna</th>
			<!--<th>Tahun Pembuatan</th>-->
			<th>Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
	$no = 1;
	foreach ($kamera as $m) {
		?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $m->kamera_merk ?></td>
				<td><?php echo $m->kamera_plat ?></td>
				<td><?php echo $m->kamera_warna ?></td>
				
				<td>
					<?php
				if ($m->kamera_status == "1") {
					echo "Tersedia";
				} else if ($m->kamera_status == "2") {
					echo "Sedang Di Rental";
				}
				?>					
				</td>
				<td> 
					<a class="btn btn-warning btn-sm" href="<?php echo base_url() . 'admin/kamera_edit/' . $m->kamera_id; ?>"><span class="glyphicon glyphicon-plus"></span> Edit</a>
					<a class="btn btn-danger btn-sm" href="<?php echo base_url() . 'admin/kamera_hapus/' . $m->kamera_id; ?>"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
				</td>
			</tr>
			<?php 
	}
	?>
	</tbody>
</table>
</div>