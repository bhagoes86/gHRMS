<h3>Data Pendidikan</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<?php echo form_open('pendidikan/index',array('class'=>'form-search pull-left', 'method'=>'GET')); ?>
	<?php echo form_input(array('name'=>'pencarian', 'class'=>"input-medium search-query")); ?>
	    <button type="submit" class="btn">Search</button>
	<?php echo form_close(); ?>
	<div class="pull-right">
		<?php echo anchor('pendidikan/tambah', 
			'<i class="icon-plus icon-white"></i> Tambah', 
			array('class'=>"btn btn-primary")); ?>
	</div>	
</div>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th width="20px">No</th>
		<th width="100px">ID</th>
		<th width="300px">Pendidikan</td>
		<th width="100px">Action</th>
	</tr>
	<?php $count = (1+$this->uri->segment(3)); ?>
	<?php foreach ($pendidikan as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['id'] ?></td>
			<td><?php echo $data['nama_pendidikan'] ?></td>
			<td>
				<?php echo anchor('pendidikan/edit/'.$data['id'], 'Edit', array('class'=>"btn btn-mini")); ?>
				<?php echo anchor('pendidikan/delete/'.$data['id'], 'Delete', array('class'=>"btn btn-mini", 'onclick'=> "return confirm('Anda yakin menghapus data?')")); ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<div class="footer_table">
	<!-- <div class="pull-left">Found: <?php echo ($jumlah) ?>Educations </div> -->
	 <?php echo $this->pagination->create_links(); ?>
</div>
	