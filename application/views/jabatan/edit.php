<?php  
	if (empty($data_jabatan)) { 
		$id = '';
		$jabatan = '';
		$tunjangan = '';
		$type = 'create';   
	} else {  
		$id = $data_jabatan->id;
		$jabatan = $data_jabatan->nama_jabatan;
		$tunjangan = $data_jabatan->tunjangan;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('jabatan/'.$type,array('class'=>'form-horizontal')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit Jabatan</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Jabatan</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'jabatan', 'value'=>$jabatan, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('jabatan'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Besar Tunjangan</label>
			<div class="controls">
				
				<div class="input-prepend">
					<span class="add-on">Rp</span><?php echo form_input(array('name'=>'tunjangan', 'value'=>$tunjangan, 'class'=>'input-large')); ?>
				</div>
				<p class="help-block"><?php echo form_error('tunjangan'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>