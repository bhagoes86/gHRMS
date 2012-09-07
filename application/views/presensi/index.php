<h3>Presensi Karyawan</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<form class="form-search pull-left">
	    <input type="text" class="input-medium search-query">
	    <button type="submit" class="btn">Search</button>
	</form>
	<div class="pull-right">
		<?php echo anchor('presensi/tambah', 
			'<i class="icon-plus icon-white"></i> Tambah', 
			array('class'=>"btn btn-primary")); ?>
	</div>	
</div>
<tr>

<?php echo form_open('presensi/submit') ?>
<input type ="text" name="tanggal" value= "01-08-2012" id="datepicker"></tr>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th width="20px">No</th>
		<th width="300px">NIK</th>
		<th width="300px">Nama</th>
		<th width="300px">Hadir</th>
		<th width="300px">Ijin</th>
		<th width="300px">Sakit</th>
		<th width="300px">Alfa</th>
		<th width="300px">Action</th>
	</tr>
	<?php $count = 1; ?>
	<?php foreach ($presensi as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['nik'] ?></td>
			<td><?php echo $data['nama_depan']. ' ' .$data['nama_belakang'] ?></td>

			<?php for ($i=1; $i < 5; $i++) { 

				if ($i == $data['keterangan']) {
					$chk = "checked='checked'";
				} else {
					$chk = '';
				}
				?>
				<td><input type="radio" <?php echo $chk ?> name='keterangan[<?php echo $data['nik'] ?>]' value='<?php echo $i ?>'></td>
			<?php } ?>
			<td>
			<?php echo anchor('presensi/delete/'.$data['id'], 'Delete', array('class'=>"btn btn-mini", 'onclick'=> "return confirm('Are you sure you want to delete?')")); ?></td>
		</tr>


	<?php endforeach ?>
</table>
<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
<?php echo form_close(); ?>
<div class="footer_table">
	<!-- <div class="pull-left">Found: <?php echo count ($presensi)?> Presensi </div> -->
	 <?php echo $this->pagination->create_links(); ?>
</div>
<script type="text/javascript">
	

</script>