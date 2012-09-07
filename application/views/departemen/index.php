<h3>Data Departemen</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<?php echo form_open('departemen/index',array('class'=>'form-search pull-left', 'method'=>'GET')); ?>
	<?php echo form_input(array('name'=>'pencarian', 'class'=>"input-medium search-query")); ?>
	    <button type="submit" class="btn">Search</button>
	<?php echo form_close(); ?>
	<div class="pull-right">
		<?php echo anchor('departemen/tambah', 
			'<i class="icon-plus icon-white"></i> Tambah', 
			array('class'=>"btn btn-primary")); ?>
	</div>	
</div>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th width="20px">No</th>
		<th width="300px">Departemen</th>
		<th width="100px">Action</th>
	</tr>
	<?php $count = (1+$this->uri->segment(3)); ?>
	<?php foreach ($departemen as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['nama_departemen'] ?></td>
			<td>
				<?php echo anchor('departemen/edit/'.$data['id'], 'Edit', array('class'=>"btn btn-mini")); ?>
				<?php echo anchor('departemen/delete/'.$data['id'], 'Delete', array('class'=>"btn btn-mini", 'onclick'=> "return confirm('Are you sure you want to delete?')")); ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<div class="footer_table">
	<!-- <div class="pull-left">Found: <?php echo count($departemen) ?> Religions</div> -->
	 <?php echo $this->pagination->create_links(); ?>
</div>
