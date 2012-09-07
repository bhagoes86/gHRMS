<h3>Data Gaji</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<form class="form-search pull-left">
	    <input type="text" class="input-medium search-query">
	    <button type="submit" class="btn">Search</button>
	</form>
	<div class="pull-right">
		<?php echo anchor('penggajian/tambah', 
			'<i class="icon-plus icon-white"></i> Tambah', 
			array('class'=>"btn btn-primary")); ?>
	</div>	
</div>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th width="20px">No</th>
		<th width="100px">ID</th>
		<th width="300px">NIK</th>
		<th width="300px">Gaji</th>
		<th width="300px">Potongan</th>
		<th width="300px">Tunjangan</th>
		<th width="300px">Pengambilan</th>
		<th width="100px">Action</th>
	</tr>
	<?php $count = 1; ?>
	<?php foreach ($penggajian as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['id'] ?></td>
			<td><?php echo $data['karyawan_id'] ?></td>
			<td><?php echo $data['gaji'] ?></td>
			<td><?php echo $data['potongan'] ?></td>
			<td><?php echo $data['tunjangan'] ?></td>
			<td><?php echo $data['tgl_pengambilan'] ?></td>
			<td>
				<?php echo anchor('penggajian/edit/'.$data['id'], 'Edit', array('class'=>"btn btn-mini")); ?>
				<?php echo anchor('penggajian/delete/'.$data['id'], 'Delete', array('class'=>"btn btn-mini", 'onclick'=> "return confirm('Anda yakin menghapus data?')")); ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<div class="footer_table">
	<div class="pull-left">Found: <?php echo ($jumlah) ?>Penggajian </div>
	 <?php echo $this->pagination->create_links(); ?>
</div>
