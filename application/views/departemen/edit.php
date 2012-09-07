<?php  
	if (empty($data_departemen)) { 
		$id = '';
		$departemen = '';
		$type = 'create';   
	} else {  
		$id = $data_departemen->id;
		$departemen = $data_departemen->nama_departemen;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('departemen/'.$type,array('class'=>'form-horizontal')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit Departemen</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Departemen</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'departemen', 'value'=>$departemen, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('departemen'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>