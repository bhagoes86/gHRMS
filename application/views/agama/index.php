<h3>Data Agama</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<?php echo form_open('agama/index',array('class'=>'form-search pull-left', 'method'=>'GET')); ?>
	<?php echo form_input(array('name'=>'pencarian', 'class'=>"input-medium search-query")); ?>
	    <button type="submit" class="btn">Search</button>
	<?php echo form_close(); ?>
	<div class="pull-right">
		<?php echo anchor('agama/tambah', 
			'<i class="icon-plus icon-white"></i> Tambah', 
			array('class'=>"btn btn-primary")); ?>
	</div>	
</div>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th width="20px">No</th>
		<th width="300px">Agama</th>
		<th>Keterangan</th>
		<th width="100px">Action</th>
	</tr>
	<?php $count = (1+$this->uri->segment(3)); ?>
	<?php foreach ($agama as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['agama'] ?></td>
			<td><?php echo $data['keterangan'] ?></td>
			<td>
				<?php echo anchor('agama/edit/'.$data['id'], 'Edit', array('class'=>"btn btn-mini")); ?>
				<?php echo anchor('agama/delete/'.$data['id'], 'Delete', array('class'=>"btn btn-mini", 'onclick'=> "return confirm('Are you sure you want to delete?')")); ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<div class="footer_table">
	<!-- <div class="pull-left">Found: <?php echo count($agama) ?> Religions</div> -->
	 <?php echo $this->pagination->create_links(); ?>
</div>
