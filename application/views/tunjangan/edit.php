<?php  
	if (empty($data_tunjangan)) { 
		$id = '';
		$tunjangan = '';
		$jumlah='';
		$status_id='';
		$type = 'create';   
	} else {  
		$id = $data_tunjangan->id;
		$tunjangan = $data_tunjangan->nama_tunjangan;
		$jumlah = $data_tunjangan ->jumlah;
		$status_id = $data_tunjangan ->status_id;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('tunjangan/'.$type,array('class'=>'form-horizontal')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit Tunjangan</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Tunjangan</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'tunjangan', 'value'=>$tunjangan, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('tunjangan'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Jumlah</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'jumlah', 'value'=>$jumlah, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('tunjangan'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Status</label>
			<div class="controls">
				<?php $status_list = form_dropdown_data(array('id','nama_status'), 'status') ?>
				<?php echo form_dropdown('status_id', $status_list, $status_id); ?>
				<p class="help-block"><?php echo form_error('tunjangan'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>