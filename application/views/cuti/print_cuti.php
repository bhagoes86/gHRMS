<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    global $template;
    $assets = base_url(). "application/views/layouts/" .$template. "/";
?>
<div id="header" style="margin-bottom:5px">
		<img src="<?php echo $assets ?>img/logo-mariza.jpg" alt="" style="float:left;width:50px;height:50px;margin-right:10px">
		<h3 style="margin:0px;padding:0px">PT.Marizarasa Sarimurni</h3>
		<p style="margin:0px;padding:0px">Jl. Raya Rangkas Bitung KM 8 Serang</p>
</div>
<hr style="margin-top:20px">
<h4>Data Cuti</h4>
<table border="1px" cellspacing="0px" cellpadding="5px">
	<tr>
		<th width="20px">No</th>
		<th width="100px">Kode Cuti</th>
		<th width="200px">NIK</th>
		<th width="200px">Nama Karyawan</th>
		<th width="200px">Jenis Cuti</th>
		<th width="200px">Tanggal Mulai</th>
		<th width="200px">Tanggal Akhir</th>
		<th width="200px">Lama Cuti</th>
		<th width="200px">Status</th>
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
		</tr>
	<?php endforeach ?>
</table>
<script type="text/javascript">window.print()</script>