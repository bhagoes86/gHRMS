<?php  
	if (empty($data_presensi)) { 
		$id = '';
		$karyawan_id = '';
		$type = 'create';   
	} else {  
		$id = $data_presensi->id;
		$karyawan_id = $data_presensi->karyawan_id;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('presensi/'.$type,array('class'=>'form-horizontal')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Presensi</legend>
		<div class="control-group">
			<label class="control-label" for="input01">NIK</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'karyawan_id', 'value'=>$karyawan_id, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('presensi'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>