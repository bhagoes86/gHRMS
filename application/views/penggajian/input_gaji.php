<?php echo display_flash('message') ?>
<div id="wrapper" class="container-fluid">
<div class="row-fluid">
<?php echo form_open('penggajian/simpan_gaji',array('class'=>'form-inline span12', 'id'=>'input-gaji')); ?>
	<fieldset>
		<legend>Input Gaji</legend>
		<br>
		<div class="row-fluid">  
			<div id="formLeft" class="span4">
				<div class="control-group">
					<label class="control-label" for="input01">Tanggal Pengajian</label>
					<div class="controls">
						<?php echo form_input(array('name'=>'tgl_penggajian', 'value'=>date('Y-m-d'), 'class'=>'input-xlarge')); ?>
						<p class="help-block"><?php echo form_error('jabatan'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Kode Karyawan</label>
					<div class="controls">
						<div class="input-append">
						  <input name="nik" class="input-medium" id="appendedInputButton" type="text"><button id="btn-cari" class="btn" type="button">Cari</button>
						</div>
						<p class="help-block"><?php echo form_error('jabatan'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Nama karyawan</label>
					<div class="controls">
						<?php echo form_input(array('name'=>'nama_karyawan', 'class'=>'input-xlarge')); ?>
						<p class="help-block"><?php echo form_error('nama_karyawan'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Alamat</label>
					<div class="controls">
						<?php echo form_textarea(array('name'=>'alamat', 'value'=>'', 'class'=>"input-xlarge", "rows"=>"4")); ?>
						<p class="help-block"><?php echo form_error('nama_karyawan'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Jabatan</label>
					<div class="controls">
						<?php echo form_input(array('name'=>'jabatan', 'class'=>'input-medium')); ?>
						<p class="help-block"><?php echo form_error('jabatan'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Gaji Pokok</label>
					<div class="controls">
						
						<div class="input-prepend">
							<span class="add-on">Rp</span><?php echo form_input(array('name'=>'gapok', 'value'=>'', 'class'=>'input-large')); ?>
						</div>
						<p class="help-block"><?php echo form_error('gapok'); ?></p>
					</div>
				</div>
			</div>
			<div id="formCenter" class="span4">
				<div class="control-group">
					<label class="control-label" for="input01">Tunjangan Jabatan</label>
					<div class="controls">
						
						<div class="input-prepend">
							<span class="add-on">Rp</span><?php echo form_input(array('name'=>'tunjangan_jabatan', 'value'=>'', 'class'=>'input-large')); ?>
						</div>
						<p class="help-block"><?php echo form_error('tunjangan_jabatan'); ?></p>
					</div>
				</div>
				<div id="tunjangan"></div>
				<hr>
				<div id="potongan"></div>
				<div class="form-actions">
					<button class="btn btn-success" id="hitungGaji">Hitung Total Gaji</button>
				</div>
			</div>
			<div id="formRight" class="well span4 hide">
				<div class="control-group">
					<label class="control-label" for="input01">Total Tunjangan</label>
					<div class="controls">
						
						<div class="input-prepend">
							<span class="add-on">Rp</span><?php echo form_input(array('name'=>'total_tunjangan', 'value'=>'', 'class'=>'input-large', 'readonly'=>'readonly')); ?>
						</div>
						<p class="help-block"><?php echo form_error('total_tunjangan'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Total Potongan</label>
					<div class="controls">
						
						<div class="input-prepend">
							<span class="add-on">Rp</span><?php echo form_input(array('name'=>'total_potongan', 'value'=>'', 'class'=>'input-large', 'readonly'=>'readonly')); ?>
						</div>
						<p class="help-block"><?php echo form_error('total_potongan'); ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Total Gaji Diterima</label>
					<div class="controls">
						
						<div class="input-prepend">
							<span class="add-on">Rp</span><?php echo form_input(array('name'=>'total_gaji', 'value'=>'', 'class'=>'input-large', 'readonly'=>'readonly')); ?>
						</div>
						<p class="help-block"><?php echo form_error('total_gaji'); ?></p>
					</div>
				</div>
				<div class="form-actions">
					<?php echo form_submit(array('name'=>'submit', 'value'=>'Simpan', 'class'=>'btn btn-primary')); ?>
				</div>
			</div>	
		</div>
		
	</fieldset>
<?php echo form_close(); ?>
</div>
</div>​
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var CI = {'base_url':'<?php echo base_url() ?>'}
		$('#btn-cari').click(function(){
			var nik = $("input[name='nik']").val()
			$.ajax({
				url: CI.base_url + 'penggajian/get_gaji',
				method: 'get',
				dataType: 'json',
				data: {nik:nik},
				success: function(data) {
					$("input[name='nama_karyawan']").val(data.result[0].nama_depan+' '+data.result[0].nama_belakang);
					$("input[name='alamat']").val(data.result[0].alamat);
					$("input[name='jabatan']").val(data.result[0].nama_jabatan);
					$("input[name='gapok']").val(data.result[0].gapok);
					if (data.tunjangan.length > 0) {
						divTunjangan = '';
						for (var i = 0; i < data.tunjangan.length; i++) {
							nama_tunjangan = data.tunjangan[i].nama_tunjangan;
							names_raw = nama_tunjangan.toLowerCase().split(" ");
							names = names_raw.join('_');
							jumlah = data.tunjangan[i].jumlah;
							divTunjangan += 
								'<div class="control-group">'+
									'<label class="control-label" for="input01">'+nama_tunjangan+'</label>'+
									'<div class="controls">'+
										'<div class="input-prepend">'+
											'<span class="add-on">Rp</span><input type="text" name="tunjangan_'+names+'" class="input-large" value="'+jumlah+'"/>'+
										'</div>'+
									'</div>'+
								'</div>';
						};
						$("#tunjangan").html(divTunjangan);	
					};

					if (data.potongan.length > 0) {
						divPotongan = '';
						for (var i = 0; i < data.potongan.length; i++) {
							nama_potongan = data.potongan[i].nama_potongan;
							names_raw = nama_potongan.toLowerCase().split(" ");
							names = names_raw.join('_');
							jumlah = data.potongan[i].jumlah;
							divPotongan += 
								'<div class="control-group">'+
									'<label class="control-label" for="input01">Potongan '+nama_potongan+'</label>'+
									'<div class="controls">'+
										'<div class="input-prepend">'+
											'<span class="add-on">Rp</span><input type="text" name="potongan_'+names+'" class="input-large" value="'+jumlah+'"/>'+
										'</div>'+
									'</div>'+
								'</div>';
						};
						$("#potongan").html(divPotongan);	
					};
				}
			});
		});
		$("#hitungGaji").click(function(){
			$("#formRight").show();
			var tunjangan = $("input[name^='tunjangan']").serializeArray();
			var potongan = $("input[name^='potongan']").serializeArray();

			var sum_tunjangan = 0;
			var sum_potongan = 0;
			var gapok = $("input[name='gapok']").val();
			$.each(tunjangan,function(){sum_tunjangan+=parseFloat(this.value) || 0;});
			$.each(potongan,function(){sum_potongan+=parseFloat(this.value) || 0;});

			$("input[name='total_tunjangan']").val(sum_tunjangan);
			$("input[name='total_potongan']").val(sum_potongan);
			$("input[name='total_gaji']").val(parseFloat(gapok) + sum_tunjangan - sum_potongan);
			return false;
		});

		$("#input-gaji").submit( function() {  
		    var post_data = $(this).serialize();  
		    var form_action = $(this).attr("action");  
		    var form_method = $(this).attr("method");  
		    $.ajax( {  
		        type :form_method,  
		        url :form_action,  
		        cache :false,  
		        data :post_data,  
		        success : function(data) {  
		            
		        }  
		    });  
		    // return false;  
		});  
	});
</script>