<h3>Data User</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<form class="form-search pull-left">
	    <input type="text" class="input-medium search-query">
	    <button type="submit" class="btn">Search</button>
	</form>
	<div class="pull-right">
		<?php echo anchor('user/tambah', 
			'<i class="icon-plus icon-white"></i> Tambah', 
			array('class'=>"btn btn-primary")); ?>
	</div>	
</div>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th width="20px">No</th>
		<th width="100px">ID</th>
		<th width="300px">Username</th>
		<th width="300px">Password</th>
		<th width="300px">Roles</th>
		<th width="100px">Action</th>
	</tr>
	<?php $count = 1; ?>
	<?php foreach ($user as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['id'] ?></td>
			<td><?php echo $data['username'] ?></td>
			<td><?php echo $data['password'] ?></td>
			<td><?php echo $data['roles_id'] ?></td>
			<td>
				<?php echo anchor('user/edit/'.$data['id'], 'Edit', array('class'=>"btn btn-mini")); ?>
				<?php echo anchor('user/delete/'.$data['id'], 'Delete', array('class'=>"btn btn-mini", 'onclick'=> "return confirm('Anda yakin menghapus data?')")); ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<div class="footer_table">
	<div class="pull-left">Found: <?php echo ($jumlah) ?> Users</div>
	 <?php echo $this->pagination->create_links(); ?>
</div>
