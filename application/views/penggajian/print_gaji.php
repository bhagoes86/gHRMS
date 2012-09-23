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
<h4>Data Gaji</h4>
<table border="1px" cellspacing="0px" cellpadding="5px">
	<tr>
		<th>No</th>
		<th>Kode Penggajian</th>
		<th>NIK</th>
		<th>Nama Karyawan</th>
		<th>Tanggal Gaji</th>
		<th>Total Diterima</th>
	</tr>
	<?php $count = 1; ?>
	<?php foreach ($penggajian as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['id'] ?></td>
			<td><?php echo $data['nik'] ?></td>
			<td><?php echo $data['nama_depan'] ?> <?php echo $data['nama_belakang'] ?></td>
			<td><?php echo $data['tgl_pengambilan'] ?></td>
			<td><?php echo $data['total_gaji'] ?></td>
		</tr>
	<?php endforeach ?>
</table>
<script type="text/javascript">window.print()</script>