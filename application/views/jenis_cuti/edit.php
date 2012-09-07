<?php  
	if (empty($data_jenis_cuti)) { 
		$id = '';
		$nama_cuti = '';
		$type = 'create';   
	} else {  
		$id = $data_jenis_cuti->id;
		$nama_cuti = $data_jenis_cuti->nama_cuti;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('jenis_cuti/'.$type,array('class'=>'form-horizontal')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit Jenis Cuti</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Nama Cuti</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'nama_cuti', 'value'=>$nama_cuti, 'class'=>'input-xlarge')); ?>
				<p class="help-inline error"><?php echo form_error('jenis_cuti'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>