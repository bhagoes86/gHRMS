<?php  
	if (empty($data_status)) { 
		$id = '';
		$status = '';
		$type = 'create';   
	} else {  
		$id = $data_status->id;
		$status = $data_status->nama_status;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('status/'.$type,array('class'=>'form-horizontal')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit status</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Status</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'status', 'value'=>$status, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('status'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>