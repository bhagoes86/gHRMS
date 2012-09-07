<?php  
	if (empty($data_penggajian_detail)) { 
		$id = '';
		$penggajian_id = '';
		$total_gaji='';
		$type = 'create';   
	} else {  
		$id = $data_penggajian_detail->id;
		$penggajian_id = $data_penggajian_detail->penggajian_id;
		$total_gaji = $data_penggajian_detail->total_gaji;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('penggajian_detail/'.$type,array('class'=>'form-horizontal')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit Detail penggajian</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Gaji</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'penggajian_id', 'value'=>$penggajian_id, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('penggajian_detail'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Total Gaji</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'total_gaji', 'value'=>$total_gaji, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('penggajian_detail'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>