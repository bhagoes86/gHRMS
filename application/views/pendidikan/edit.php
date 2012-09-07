<?php  
	if (empty($data_pendidikan)) { 
		$id = '';
		$nama_pendidikan = '';
		$type = 'create';   
	} else {  
		$id = $data_pendidikan->id;
		$nama_pendidikan = $data_pendidikan->nama_pendidikan;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('pendidikan/'.$type,array('class'=>'form-horizontal')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit Pendidikan</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Pendidikan</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'nama_pendidikan', 'value'=>$nama_pendidikan, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('pendidikan'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>