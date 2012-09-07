<h3>Data Potongan</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<?php echo form_open('potongan/index',array('class'=>'form-search pull-left', 'method'=>'GET')); ?>
	<?php echo form_input(array('name'=>'pencarian', 'class'=>"input-medium search-query")); ?>
	    <button type="submit" class="btn">Search</button>
	<?php echo form_close(); ?>
	<div class="pull-right">
		<?php echo anchor('potongan/tambah', 
			'<i class="icon-plus icon-white"></i> Tambah', 
			array('class'=>"btn btn-primary")); ?>
	</div>	
</div>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th width="20px">No</th>
		<th width="100px">ID</th>
		<th width="300px">Potongan</th>
		<th width="300px">Jumlah</th>
		<th width="300px">Status</th>
		<th width="100px">Action</th>
	</tr>
	<?php $count = (1+$this->uri->segment(3)); ?>	
	<?php foreach ($potongan as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['id'] ?></td>
			<td><?php echo $data['nama_potongan'] ?></td>
			<td><?php echo $data['jumlah'] ?></td>
			<td><?php echo $data['nama_status'] ?></td>
			<td>
				<?php echo anchor('potongan/edit/'.$data['id'], 'Edit', array('class'=>"btn btn-mini")); ?>
				<?php echo anchor('potongan/delete/'.$data['id'], 'Delete', array('class'=>"btn btn-mini", 'onclick'=> "return confirm('Anda yakin menghapus data?')")); ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<div class="footer_table">
	<!-- <div class="pull-left">Found: <?php echo ($jumlah) ?>Potongan </div> -->
	 <?php echo $this->pagination->create_links(); ?>
</div>
