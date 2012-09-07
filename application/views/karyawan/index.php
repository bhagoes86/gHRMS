<h3>Data Karyawan</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<?php echo form_open('karyawan/index',array('class'=>'form-search pull-left', 'method'=>'GET')); ?>
	<?php echo form_input(array('name'=>'pencarian', 'class'=>"input-medium search-query")); ?>
	    <button type="submit" class="btn">Search</button>
	<?php echo form_close(); ?>
	<div class="pull-right">
		<?php echo anchor('karyawan/tambah', 
			'<i class="icon-plus icon-white"></i> Tambah', 
			array('class'=>"btn btn-primary")); ?>
	</div>	
</div>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th width="20px">#</th>
		<th width="100px">NIK</th>
		<th width="300px">Nama Lengkap</th>
		<th>Departemen</th>
		<th>Jabatan</th>
		<th>Status</th>
		<th width="100px">Action</th>
	</tr>
	<?php $count = (1+$this->uri->segment(3)); ?>
	<?php foreach ($karyawan as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['nik'] ?></td>
			<td><?php echo $data['nama_depan']. ' ' .$data['nama_belakang'] ?></td>
			<td><?php echo $data['nama_departemen'] ?></td>
			<td><?php echo $data['nama_jabatan'] ?></td>
			<td><?php echo $data['nama_status'] ?></td>
			<td>
				<?php echo anchor('karyawan/edit/'.$data['id'], 'Edit', array('class'=>"btn btn-mini")); ?>
				<?php echo anchor('karyawan/delete/'.$data['id'], 'Delete', array('class'=>"btn btn-mini", 'onclick'=> "return confirm('Are you sure you want to delete?')")); ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<div class="footer_table">
	<div class="pull-left">Found: <?php echo ($count-1) ?> Karyawan</div>
	 <?php echo $this->pagination->create_links(); ?>
</div>
