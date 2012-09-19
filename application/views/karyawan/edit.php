<?php  
	if (empty($data_karyawan)) { 
		$id = '';
		$nik = '';
		$nama_depan = '';
		$nama_belakang = '';
		$npwp = '';
		$tempat_lahir = '';
		$tanggal_lahir = '';
		$sex = '';
		$no_telp = '';
		$email = '';
		$alamat = '';
		$departemen_id = '';
		$cabang_id = '';
		$jabatan_id = '';
		$pendidikan_id = '';
		$agama_id = '';
		$status_id = '';
		$gol_darah = '';
		$no_rekening = '';
		$status_nikah = '';
		$gapok = '';
		$type = 'create';   
	} else {  
		$id = $data_karyawan->id;
		$nik = $data_karyawan->nik;
		$nama_depan = $data_karyawan->nama_depan;
		$nama_belakang = $data_karyawan->nama_belakang;
		$npwp = $data_karyawan->npwp;
		$tempat_lahir = $data_karyawan->tempat_lahir;
		$tanggal_lahir = $data_karyawan->tanggal_lahir;
		$sex = $data_karyawan->sex;
		$no_telp = $data_karyawan->no_telp;
		$email = $data_karyawan->email;
		$alamat = $data_karyawan->alamat;
		$departemen_id = $data_karyawan->departemen_id;
		$cabang_id = $data_karyawan->cabang_id;
		$jabatan_id = $data_karyawan->jabatan_id;
		$pendidikan_id = $data_karyawan->pendidikan_id;
		$agama_id = $data_karyawan->agama_id;
		$status_id = $data_karyawan->status_id;
		$gol_darah = $data_karyawan->gol_darah;
		$no_rekening = $data_karyawan->no_rekening;
		$status_nikah = $data_karyawan->status_nikah;
		$gapok = $data_karyawan->gapok;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<?php echo form_open('karyawan/'.$type,array('class'=>'form-horizontal', 'id'=>'karyawan-form')); ?>
<?php echo form_hidden('id', $id); ?>
	<fieldset>
		<legend>Edit Karyawan</legend>
		<div class="control-group">
			<label class="control-label" for="input01">NIK</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'nik', 'value'=>$nik, 'class'=>'input-medium')); ?>
				<p class="help-inline error"><?php echo form_error('nik'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Nama Depan</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'nama_depan', 'value'=>$nama_depan, 'class'=>'input-xlarge')); ?>
				<p class="help-inline error"><?php echo form_error('nama_depan'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Nama Belakang</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'nama_belakang', 'value'=>$nama_belakang, 'class'=>'input-xlarge')); ?>
				<p class="help-inline error"><?php echo form_error('nama_belakang'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">NPWP</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'npwp', 'value'=>$npwp, 'class'=>'input-large')); ?>
				<p class="help-inline error"><?php echo form_error('npwp'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Tempat Lahir</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'tempat_lahir', 'value'=>$tempat_lahir, 'class'=>'input-large')); ?>
				<p class="help-inline error"><?php echo form_error('tempat_lahir'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Tanggal Lahir</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'tanggal_lahir', 'value'=>$tanggal_lahir, 'class'=>'input-medium datepicker')); ?>
				<p class="help-inline error"><?php echo form_error('tanggal_lahir'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Jenis Kelamin</label>
			<div class="controls">
				<label class="radio inline">
					<input type="radio" name="sex" value="l" <?php echo ($sex == 'l') ? 'checked' : '' ?>> Laki-Laki
				</label>
				<label class="radio inline">
					<input type="radio" name="sex" value="p" <?php echo ($sex == 'p') ? 'checked' : '' ?>> Perempuan
				</label>
				<p class="help-inline error"><?php echo form_error('sex'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">No Telp</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'no_telp', 'value'=>$no_telp, 'class'=>'input-large')); ?>
				<p class="help-inline error"><?php echo form_error('no_telp'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Email</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'email', 'value'=>$email, 'class'=>'input-xlarge')); ?>
				<p class="help-inline error"><?php echo form_error('email'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Alamat</label>
			<div class="controls">
				<?php echo form_textarea(array('name'=>'alamat', 'value'=>$alamat, 'class'=>"input-xlarge", "rows"=>"4")); ?>
				<p class="help-inline error"><?php echo form_error('alamat'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Departemen</label>
			<div class="controls">
				<?php $departemen_list = form_dropdown_data(array('id','nama_departemen'), 'departemen') ?>
				<?php echo form_dropdown('departemen_id', $departemen_list, $departemen_id); ?>
				<p class="help-inline error"><?php echo form_error('departemen_id'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Cabang</label>
			<div class="controls">
				<?php $cabang_list = form_dropdown_data(array('id','nama_cabang'), 'cabang') ?>
				<?php echo form_dropdown('cabang_id', $cabang_list, $cabang_id); ?>
				<p class="help-inline error"><?php echo form_error('cabang_id'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Jabatan</label>
			<div class="controls">
				<?php $jabatan_list = form_dropdown_data(array('id','nama_jabatan'), 'jabatan') ?>
				<?php echo form_dropdown('jabatan_id', $jabatan_list, $jabatan_id); ?>
				<p class="help-inline error"><?php echo form_error('jabatan_id'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Agama</label>
			<div class="controls">
				<?php $agama_list = form_dropdown_data(array('id','agama'), 'agama') ?>
				<?php echo form_dropdown('agama_id', $agama_list, $agama_id); ?>
				<p class="help-inline error"><?php echo form_error('agama_id'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Status Karyawan</label>
			<div class="controls">
				<?php $status_list = form_dropdown_data(array('id','nama_status'), 'status') ?>
				<?php echo form_dropdown('status_id', $status_list, $status_id); ?>
				<p class="help-inline error"><?php echo form_error('status_id'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Pendidikan</label>
			<div class="controls">
				<?php $pendidikan_list = form_dropdown_data(array('id','nama_pendidikan'), 'pendidikan') ?>
				<?php echo form_dropdown('pendidikan_id', $pendidikan_list, $pendidikan_id); ?>
				<p class="help-inline error"><?php echo form_error('pendidikan_id'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Golongan Darah</label>
			<div class="controls">
				<label class="radio inline">
					<input type="radio" name="gol_darah" value="A" <?php echo ($gol_darah == 'A') ? 'checked' : '' ?>> A
				</label>
				<label class="radio inline">
					<input type="radio" name="gol_darah" value="B" <?php echo ($gol_darah == 'B') ? 'checked' : '' ?>> B
				</label>
				<label class="radio inline">
					<input type="radio" name="gol_darah" value="AB" <?php echo ($gol_darah == 'AB') ? 'checked' : '' ?>> AB
				</label>
				<label class="radio inline">
					<input type="radio" name="gol_darah" value="O" <?php echo ($gol_darah == 'O') ? 'checked' : '' ?>> O
				</label>
				<p class="help-inline error"><?php echo form_error('gol_darah'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">No Rekening</label>
			<div class="controls">
				<?php echo form_input(array('name'=>'no_rekening', 'value'=>$no_rekening, 'class'=>'input-xlarge')); ?>
				<p class="help-inline error"><?php echo form_error('no_rekening'); ?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Status Nikah</label>
			<div class="controls">
				<label class="radio inline">
					<input type="radio" name="status_nikah" value="nikah" <?php echo ($status_nikah == 'nikah') ? 'checked' : '' ?>> Nikah
				</label>
				<label class="radio inline">
					<input type="radio" name="status_nikah" value="lajang" <?php echo ($status_nikah == 'lajang') ? 'checked' : '' ?>> Lajang
				</label>
				<p class="help-inline error"><?php echo form_error('status_nikah'); ?></p>
			</div>
		</div>
		<hr>
		<div class="control-group">
			<label class="control-label" for="textarea">Gaji Pokok</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">Rp</span><?php echo form_input(array('name'=>'gapok', 'value'=>$gapok, 'class'=>'input-xlarge')); ?>
				</div>
				<p class="help-inline error"><?php echo form_error('gapok'); ?></p>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
			<button class="btn">Cancel</button>
		</div>
	</fieldset>
<?php echo form_close(); ?>
<script type="text/javascript">

</script>