<?php  
	if (empty($data_cuti)) { 
		$kd_pcuti = '';
		$nik = '';
		$jenis_cuti_id = '';
		$tanggal_mulai ='';
		$tanggal_akhir = '';
		$alasan = '';
		$status_pengajuan = '';
		$type = 'create';   
	} else {  
		$kd_pcuti = $data_cuti->kd_pcuti;
		$nik = $data_cuti->nik;
		$jenis_cuti_id = $data_cuti->jenis_cuti_id;
		$tanggal_mulai =$data_cuti->tgl_mulai;
		$tanggal_akhir = $data_cuti->tgl_akhir;
		$alasan = $data_cuti->alasan;
		$status_pengajuan = $data_cuti->status_pengajuan;
		$type = 'update';  
	}  
?>  
<?php echo display_flash('message') ?>
<div id="wrapper" class="container-fluid">
<?php echo form_open('cuti/'.$type,array('class'=>'form-inline span12')); ?>
<?php echo form_hidden('kd_pcuti', $kd_pcuti); ?>
	<fieldset>
		<legend>Permohonan Cuti</legend>
		<div class="row-fluid">  
			<div id="formLeft" class="span4">
				<div class="control-group">
					<label class="control-label" for="input01">NIK</label>
					<div class="controls">
						<?php echo form_input(array('name'=>'nik', 'value'=>$nik, 'class'=>'input-large')); ?> <button id="btn-cari" class="btn" type="button">Cari</button>
						<p class="help-block"><?php echo form_error('nik'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Nama karyawan</label>
					<div class="controls">
						<?php echo form_input(array('name'=>'nama_karyawan', 'class'=>'input-xlarge', 'disabled'=>'disabled')); ?>
						<p class="help-block"><?php echo form_error('nama_karyawan'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Alamat</label>
					<div class="controls">
						<?php echo form_textarea(array('name'=>'alamat', 'value'=>'', 'class'=>"input-xlarge", "rows"=>"4", 'disabled'=>'disabled')); ?>
						<p class="help-block"><?php echo form_error('nama_karyawan'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Jabatan</label>
					<div class="controls">
						<?php echo form_input(array('name'=>'jabatan', 'class'=>'input-medium', 'disabled'=>'disabled')); ?>
						<p class="help-block"><?php echo form_error('jabatan'); ?></p>
					</div>
				</div>
			</div>
			<div id="formRight" class="span4">
				<div class="control-group">
					<label class="control-label" for="textarea">Jenis Cuti</label>
					<div class="controls">
						<?php $cuti_list = form_dropdown_data(array('id','nama_cuti'), 'jenis_cuti') ?>
						<?php echo form_dropdown('jenis_cuti_id', $cuti_list, $jenis_cuti_id); ?>
						<p class="help-inline error"><?php echo form_error('jenis_cuti_id'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="textarea">Tanggal Mulai</label>
					<div class="controls">
						<?php echo form_input(array('name'=>'tanggal_mulai', 'value'=>$tanggal_mulai, 'class'=>'input-medium datepicker')); ?>
						<p class="help-inline error"><?php echo form_error('tanggal_mulai'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="textarea">Tanggal Akhir</label>
					<div class="controls">
						<?php echo form_input(array('name'=>'tanggal_akhir', 'value'=>$tanggal_akhir, 'class'=>'input-medium datepicker')); ?>
						<p class="help-inline error"><?php echo form_error('tanggal_akhir'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="textarea">Alasan</label>
					<div class="controls">
						<?php echo form_textarea(array('name'=>'alasan', 'value'=>$alasan, 'class'=>"input-xlarge", "rows"=>"4")); ?>
						<p class="help-inline error"><?php echo form_error('alasan'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="textarea">Status Pengajuan</label>
					<div class="controls">
						<label class="checkbox">
						  <?php $checked = ($status_pengajuan == 1) ? 'checked' : '' ?>
                		  	<input name="status_pengajuan" type="checkbox" <?php echo $checked ?>>Approve
						  
						</label>
					</div>
				</div>
				<div class="form-actions">
					<?php echo form_submit(array('name'=>'submit', 'value'=>'Save changes', 'class'=>'btn btn-primary')); ?>
					<button class="btn">Cancel</button>
				</div>
			</div>
			<div id="formLeft" class="span4">

			</div>
		</div>
	</fieldset>
<?php echo form_close(); ?>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var CI = {'base_url':'<?php echo base_url() ?>'}
		$('#btn-cari').click(function(){
			var nik = $("input[name='nik']").val()
			$.ajax({
				url: CI.base_url + 'cuti/karyawan_info',
				method: 'get',
				dataType: 'json',
				data: {nik:nik},
				success: function(data) {
					// console.log(data);
					$("input[name='nama_karyawan']").val(data.nama_depan+' '+data.nama_belakang);
					$("input[name='alamat']").val(data.alamat);
					$("input[name='jabatan']").val(data.nama_jabatan);
				}
			});
		});

		$('input[name="tanggal_mulai"].datepicker').datepicker({format: 'yyyy-mm-dd', startDate: window.now.date})
			   	.on('changeDate', function(ev){
				    $(this).datepicker('hide');
				});
		$('input[name="tanggal_akhir"].datepicker').datepicker({format: 'yyyy-mm-dd', startDate: window.now.date})
			   	.on('changeDate', function(ev){
				    $(this).datepicker('hide');
				});
	});
	
</script>