<h3>Data Permohonan Cuti</h3>
<hr>
<?php echo display_flash('message') ?>
<div class="addition">
	<?php echo form_open('cuti/index',array('class'=>'form-search pull-left', 'method'=>'GET')); ?>
	<?php echo form_input(array('name'=>'pencarian', 'class'=>"input-medium search-query")); ?>
	    <button type="submit" class="btn">Search</button>
	<?php echo form_close(); ?>
	<div class="pull-right">
		<?php echo anchor('cuti/tambah', 
			'<i class="icon-plus icon-white"></i> Tambah', 
			array('class'=>"btn btn-primary")); ?>
		<?php echo anchor('cuti/print_cuti', 
			'<i class="icon-print icon-white"></i> Report', 
			array('class'=>"btn btn-primary")); ?>
	</div>	
</div>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th width="20px">No</th>
		<th width="80px">Kode Cuti</th>
		<th width="150px">NIK</th>
		<th width="200px">Nama Karyawan</th>
		<th width="200px">Jenis Cuti</th>
		<th width="100px">Tanggal Mulai</th>
		<th width="100px">Tanggal Akhir</th>
		<th width="100px">Lama Cuti</th>
		<th width="50px">Status</th>
		<th width="100px">Action</th>
	</tr>
	<?php $count = (1+$this->uri->segment(3)); ?>
	<?php foreach ($cuti as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['kd_pcuti'] ?></td>
			<td><?php echo $data['nik'] ?></td>
			<td><?php echo $data['nama_depan'] ?> <?php echo $data['nama_belakang'] ?></td>
			<td><?php echo $data['nama_cuti'] ?></td>
			<td><?php echo $data['tgl_mulai'] ?></td>
			<td><?php echo $data['tgl_akhir'] ?></td>
			<td><?php echo $data['lama_cuti'] ?></td>
			<td><?php echo oknot($data['status_pengajuan']) ?></td>
			<td>
				<?php echo anchor('cuti/edit/'.$data['kd_pcuti'], 'Edit', array('class'=>"btn btn-mini")); ?>
				<?php echo anchor('cuti/delete/'.$data['kd_pcuti'], 'Delete', array('class'=>"btn btn-mini", 'onclick'=> "return confirm('Are you sure you want to delete?')")); ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<div class="footer_table">
	<!-- <div class="pull-left">Found: <?php echo count($cuti) ?> Religions</div> -->
	 <?php echo $this->pagination->create_links(); ?>
</div>
