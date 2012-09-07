<?php  
	if (empty($data_agama)) { 
		$id = '';
		$agama = '';
		$keterangan = '';
		$type = 'create';   
	} else {  
		$id = $data_agama->id;
		$agama = $data_agama->agama;
		$keterangan = $data_agama->keterangan;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('agama/'.$type,array('class'=>'form-horizontal', 'id'=>'agama-form')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit Agama</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Agama</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'agama', 'value'=>$agama, 'class'=>'input-xlarge')); ?>
				<p class="help-inline error"><?php echo form_error('agama'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Keterangan</label>
			<div class="controls">
				<?php echo form_textarea(array('name'=>'keterangan', 'value'=>$keterangan, 'class'=>"input-xlarge", "rows"=>"4")); ?>
				<p class="help-inline error"><?php echo form_error('keterangan'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>