<h3>Absensi Karyawan</h3>
<hr>
<div class="addition well">
	<div class="form-inline">
		Masukkan NIK : <input name="nik" class="input-medium" id="appendedInputButton" type="text">
	</div>
</div>
<div id="tanggal">Tanggal : <b> <?php echo date('d M Y') ?></b><div class="pull-right">
		<?php echo anchor('presensi/rekap', 
			'<i class="icon-list icon-white"></i> Rekap', 
			array('class'=>"btn btn-primary")); ?>
	</div>	</div>

<hr>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th width="20px">No</th>
		<th width="100px">Tanggal</th>
		<th width="300px">Nama</td>
		<th width="300px">Jabatan</td>
		<th width="100px">Jam Masuk</th>
		<th width="100px">Jam Keluar</th>
	</tr>
	<?php $count = 1; if (count($data_presensi) > 0): ?>
		<?php foreach ($data_presensi as $data): ?>
			<tr>
				<td><?php echo $count++; ?></td>
				<td><?php echo $data['tanggal'] ?></td>
				<td><?php echo $data['nama_depan'] ?> <?php echo $data['nama_belakang'] ?></td>
				<td><?php echo $data['nama_jabatan'] ?></td>
				<td><?php echo $data['jam_masuk'] ?></td>
				<td><?php echo $data['jam_keluar'] ?></td>
			</tr>
		<?php endforeach; $count++; ?>
	<?php else: ?>
		<tr>
			<td colspan="6"><i>Belum ada data</i></td>
		</tr>
	<?php endif ?>
	
</table>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var CI = {'base_url':'<?php echo base_url() ?>'}
		$("input[name='nik']").focus();
		$("input[name='nik']").keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13'){
				var nik = $(this).val();
				$.ajax({
					url: CI.base_url + 'presensi/check_in',
					method: 'get',
					data: {nik: nik},
					success: function(data){
						window.location = CI.base_url + "presensi/index";
					}
				});
			}

		});
	});
</script>