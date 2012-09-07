<?php  
	if (empty($data_potongan)) { 
		$id = '';
		$nama_potongan='';
		$jumlah='';
		$status_id='';
		$type = 'create';   
	} else {  
		$id = $data_potongan->id;
		$nama_potongan = $data_potongan->nama_potongan;
		$jumlah = $data_potongan ->jumlah;
		$status_id = $data_potongan ->status_id;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('potongan/'.$type,array('class'=>'form-horizontal')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit Potongan</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Potongan</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'nama_potongan', 'value'=>$nama_potongan, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('nama_potongan'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Jumlah</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'jumlah', 'value'=>$jumlah, 'class'=>'input-xlarge')); ?>
				<p class="help-block"><?php echo form_error('jumlah'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Status</label>
			<div class="controls">
				<?php $status_list = form_dropdown_data(array('id','nama_status'), 'status') ?>
				<?php echo form_dropdown('status_id', $status_list, $status_id); ?>
				<p class="help-block"><?php echo form_error('status_id'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>