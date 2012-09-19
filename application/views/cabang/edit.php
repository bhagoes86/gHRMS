<?php  
	if (empty($data_cabang)) { 
		$id = '';
		$nama_cabang = '';
		$keterangan = '';
		$type = 'create';   
	} else {  
		$id = $data_cabang->id;
		$nama_cabang = $data_cabang->nama_cabang;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('cabang/'.$type,array('class'=>'form-horizontal', 'id'=>'nama_cabang-form')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit Cabang</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Cabang</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'nama_cabang', 'value'=>$nama_cabang, 'class'=>'input-xlarge')); ?>
				<p class="help-inline error"><?php echo form_error('cabang'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>