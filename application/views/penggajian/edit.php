<?php  
	if (empty($data_penggajian)) { 
		$id = '';
		$karyawan_id='';
		$gaji='';
		$potongan='';
		$tunjangan='';
		$tgl_pengambilan='';
		$type = 'create';   
	} else {  
		$id = $data_penggajian->id;
		$karyawan_id = $data_penggajian->karyawan_id;
		$gaji = $data_penggajian ->gaji;
		$potongan = $data_penggajian ->potongan;
		$tunjangan = $data_penggajian ->tunjangan;
		$tgl_pengambilan = $data_penggajian ->tgl_pengambilan;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('penggajian/'.$type,array('class'=>'form-vertical')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit Penggajian</legend>
		<div class="control-group">
			<label class="control-label" for="input01">NIK</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'karyawan_id', 'value'=>$karyawan_id, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('penggajian'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Gaji</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'gaji', 'value'=>$gaji, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('penggajian'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Potongan</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'potongan', 'value'=>$potongan, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('penggajian'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Tunjangan</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'tunjangan', 'value'=>$tunjangan, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('penggajian'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Tanggal Pengambilan</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'tgl_pengambilan', 'value'=>$tgl_pengambilan, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('penggajian'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>