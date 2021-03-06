<h3>Penggajian</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<form id="search_gaji" class="form-inline" method="post">
		<input name="search" class="input-large" type="text" placeholder="Search">
		<select name="by" class='input-medium'>
			<option value="nik">NIK</option>
			<option value="nama">Nama Depan</option>
		</select>
	 	<select name="month" class="input-small">
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
	 	<select name="year" class="input-mini">
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
			<td><input name="gaji[]" type="checkbox" value="<?php echo $data['id'] ?>" checked></td>
		</tr>
	<?php endforeach ?>
</table>
<div class="footer_table">
	<div class="pull-right"><button id="cetak" class="btn btn-primary"><i class="icon-print icon-white"></i> Cetak</button></div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var CI = {'base_url':'<?php echo base_url() ?>'}
		$("button#cetak").click(function(){
			var selectedItems = new Array();
			$("input[@name='gaji[]']:checked").each(function() {selectedItems.push($(this).val());});
			if (selectedItems .length == 0) 
				alert("Tidak ada data gaji yang dipilih.");
			else
				window.location = CI.base_url+"penggajian/print_gaji?items=" + selectedItems.join('|');
		});

		
	});
</script>