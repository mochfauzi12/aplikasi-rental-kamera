
<div class="page-header">
	<h3>Data Kostumer</h3>
</div>

<a href="<?php echo base_url() . 'admin/kostumer_add'; ?>" class="btn btn-sm btn-primary"><span class='glyphicon glyphicon-plus'></span> Kostumer Baru Sewa Kamera</a>
<br/>
<br/>
<div class="table-responsive">	
	<table class="table table-bordered table-hover table-striped" id="table-datatable">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Jenis Kelamin</th>
				<th>Alamat</th>			
				<th>HP</th>
				<th>No. KTP</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php 
		$no = 1;
		foreach ($kostumer as $k) {
			?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $k->kostumer_nama ?></td>
					<td><?php echo $k->kostumer_jk ?></td>
					<td><?php echo $k->kostumer_alamat ?></td>
					<td><?php echo $k->kostumer_hp ?></td>
					<td><?php echo $k->kostumer_ktp ?></td>				
					<td> 
						<a class="btn btn-sm btn-warning" href="<?php echo base_url() . 'admin/kostumer_edit/' . $k->kostumer_id; ?>"><span class="glyphicon glyphicon-wrench"></span> Edit</a>
						<a class="btn btn-sm btn-danger" href="<?php echo base_url() . 'admin/kostumer_hapus/' . $k->kostumer_id; ?>"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
					</td>
				</tr>
				<?php 
		}
		?>
		</tbody>
	</table>
</div>