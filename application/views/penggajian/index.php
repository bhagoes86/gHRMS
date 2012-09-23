<h3>Penggajian</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<form class="form-inline">
		<input name="search" class="input-xlarge" type="text" placeholder="Search">
	 	<select name="month" class="input-medium">
	 		<option value="1">Januari</option>
	 		<option value="2">Pebruari</option>
	 		<option value="3">Maret</option>
	 		<option value="4">April</option>
	 		<option value="5">Mei</option>
	 		<option value="6">Juni</option>
	 		<option value="7">Juli</option>
	 		<option value="8">Agustus</option>
	 		<option value="9">September</option>
	 		<option value="10">Oktober</option>
	 		<option value="11">November</option>
	 		<option value="12">Desember</option>
	 	</select>
	 	<select name="year" class="input-medium">
	 		<option value="2012">2012</option>
	 		<option value="2011">2011</option>
	 		<option value="2010">2010</option>
	 		<option value="2009">2009</option>
	 	</select>
	  	<button type="submit" class="btn">Search</button>
	</form>
</div>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th width="20px">No</th>
		<th width="100px">Kode Penggajian</th>
		<th width="300px">NIK</th>
		<th width="300px">Nama Karyawan</th>
		<th width="300px">Tanggal Gaji</th>
		<th width="300px">Total Diterima</th>
		<th></th>
	</tr>
	<?php $count = 1; ?>
	<?php foreach ($penggajian as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['id'] ?></td>
			<td><?php echo $data['nik'] ?></td>
			<td><?php echo $data['nama_depan'] ?> <?php echo $data['nama_belakang'] ?></td>
			<td><?php echo $data['tgl_pengambilan'] ?></td>
			<td><?php echo $data['total_gaji'] ?></td>
			<td><input type="checkbox" value="" checked></td>
		</tr>
	<?php endforeach ?>
</table>
<div class="footer_table">
	<div class="pull-right"><button class="btn btn-primary"><i class="icon-print icon-white"></i> Cetak</button></div>
</div>
