<h3>Status Karyawan</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<?php echo form_open('status/index',array('class'=>'form-search pull-left', 'method'=>'GET')); ?>
	<?php echo form_input(array('name'=>'pencarian', 'class'=>"input-medium search-query")); ?>
	    <button type="submit" class="btn">Search</button>
	<?php echo form_close(); ?>
	<div class="pull-right">
		<?php echo anchor('status/tambah', 
			'<i class="icon-plus icon-white"></i> Tambah', 
			array('class'=>"btn btn-primary")); ?>
	</div>	
</div>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th width="20px">No</th>
		<th width="100px">Kode Status</th>
		<th width="300px">Jenis Status</td>
		<th width="100px">Action</th>
	</tr>
	<?php $count = (1+$this->uri->segment(3)); ?>
	<?php foreach ($status as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['id'] ?></td>
			<td><?php echo $data['nama_status'] ?></td>
			<td>
				<?php echo anchor('status/edit/'.$data['id'], 'Edit', array('class'=>"btn btn-mini")); ?>
				<?php echo anchor('status/delete/'.$data['id'], 'Delete', array('class'=>"btn btn-mini", 'onclick'=> "return confirm('Anda yakin menghapus data?')")); ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<div class="footer_table">
	<!-- <div class="pull-left">Found: <?php echo ($jumlah) ?>Educations </div> -->
	 <?php echo $this->pagination->create_links(); ?>
</div>
