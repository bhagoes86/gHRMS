<?php echo form_open('presensi/generate',array('class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>Rekap Presensi</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Dari Tanggal</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'dari', 'value'=>'','class'=>'input-large datepicker')); ?>
				<p class="help-block"></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input01">Sampai Tanggal</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'sampai', 'value'=>'','class'=>'input-large datepicker')); ?>
				<p class="help-block"></p>
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Generate</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>

