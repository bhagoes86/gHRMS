<h3>Data Tunjangan</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<?php echo form_open('tunjangan/index',array('class'=>'form-search pull-left', 'method'=>'GET')); ?>
	<?php echo form_input(array('name'=>'pencarian', 'class'=>"input-medium search-query")); ?>
	    <button type="submit" class="btn">Search</button>
	<?php echo form_close(); ?>
	<div class="pull-right">
		<?php echo anchor('tunjangan/tambah', 
			'<i class="icon-plus icon-white"></i> Tambah', 
			array('class'=>"btn btn-primary")); ?>
	</div>	
</div>
<table class="table table-striped table-bordered table-condensed">
     <tr>
		<th width="20px">No</th>
		<th width="100px">ID</th>
		<th width="300px">Tunjangan</th>
		<th width="300px">Jumlah</th>
		<th width="300px">Status</th>
		<th width="100px">Action</th>
	</tr>
	<?php $count = (1+$this->uri->segment(3)); ?>
	<?php foreach ($tunjangan as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['id'] ?></td>
			<td><?php echo $data['nama_tunjangan'] ?></td>
			<td><?php echo $data['jumlah'] ?></td>
			<td><?php echo $data['nama_status'] ?></td>
			<td>
				<?php echo anchor('tunjangan/edit/'.$data['id'], 'Edit', array('class'=>"btn btn-mini")); ?>
				<?php echo anchor('tunjangan/delete/'.$data['id'], 'Delete', array('class'=>"btn btn-mini", 'onclick'=> "return confirm('Anda yakin menghapus data?')")); ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<div class="footer_table">
	<!-- <div class="pull-left">Found: <?php echo ($jumlah) ?>Tunjangan </div> -->
	 <?php echo $this->pagination->create_links(); ?>
</div>
