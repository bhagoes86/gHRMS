<h3>Potongan Karyawan</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<form class="form-search pull-left">
	    <input type="text" class="input-medium search-query">
	    <button type="submit" class="btn">Search</button>
	</form>
	<div class="pull-right">
		<?php echo anchor('karyawan_potongan/tambah', 
			'<i class="icon-plus icon-white"></i> tambah', 
			array('class'=>"btn btn-primary")); ?>
	</div>	
</div>
<tr>

<?php echo form_open('karyawan_potongan/edit') ?>
<input type ="text" name="tanggal" value= "01-08-2012" id="datepicker"></tr>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th width="20px">No</th>
		<th width="300px">Status</th>
		<th width="300px">Nama</th>
		<th width="300px">Jenis Potongan</th>
		<th width="300px">Keterangan</th>
		<th width="300px">Tanggal Update</th>
		<th width="300px">action</th>
	</tr>
	<?php $count = 1; ?>
	<?php foreach ($karyawan_potongan as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['status_id'] ?></td>
			<td><?php echo $data['nama_depan']. ' ' .$data['nama_belakang'] ?></td>
			<td><?php echo $data['tunjangan_id']?></td>
			<td><?php echo $data['keterangan']?></td>
			<td><?php echo $data['tgl_update']?></td>
			<td>
				<?php echo anchor('karyawan_potongan/edit/'.$data['id'], 'Edit', array('class'=>"btn btn-mini")); ?>
				<?php echo anchor('karyawan_potongan/delete/'.$data['id'], 'Delete', array('class'=>"btn btn-mini", 'onclick'=> "return confirm('Are you sure you want to delete?')")); ?>
			</td>
		</tr>

	<?php endforeach ?>
</table>
<?php echo form_close(); ?>
<div class="footer_table">
	<div class="pull-left">Found: <?php echo count($karyawan_potongan) ?> Potongan Karyawan</div>
	 <?php echo $this->pagination->create_links(); ?>
</div>
<script type="text/javascript">
	

</script>