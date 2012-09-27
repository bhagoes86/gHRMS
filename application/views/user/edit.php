<?php  
	if (empty($data_user)) { 
		$id = '';
		$username = '';
		$password = '';
		$type = 'create';   
	} else {  
		$id = $data_user->id;
		$username = $data_user->username;
		$password = '';
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('user/'.$type,array('class'=>'form-horizontal')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit User</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Username</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'username', 'value'=>$username, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('user'); ?></p>
			</div>
		<div class="control-group">
			<label class="control-label" for="input01">Password</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'password', 'value'=>$password, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('user'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>