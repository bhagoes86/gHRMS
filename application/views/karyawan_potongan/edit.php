<?php  
	if (empty($data_karyawan_potongan)) { 
		$id = '';
		$karyawan_id = '';
		$potongan_id='';
		$Keterangan='';
		$tgl_update='';
		$type = 'create';   
	} else {  
		$id = $data_karyawan_potongan->id;
		$karyawan_id = $data_karyawan_potongan->nama_potongan;
		$potongan_id = $data_karyawan_potongan ->potongan_id;
		$keterangan = $data_karyawan_potongan ->keterangan;
		$tgl_update = $data_karyawan_potongan ->tgl_update;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('karyawan_potongn/'.$type,array('class'=>'form-horizontal')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit Tunjangan Karyawan</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Status Karyawan</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'status_id', 'value'=>$status_id, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('karyawan_tunjangan'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Potongan</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'tunjangan_id', 'value'=>$tunjangan_id, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('karyawan_tunjangan'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Keterangan</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'keterangan', 'value'=>$keterangan, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('karyawan_tunjangan'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Tanggal_Update</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'tgl_update', 'value'=>$tgl_update, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('karyawan_tunjangan'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>