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
<h4>Data Karyawan</h4>
<table border="1px" cellspacing="0px" cellpadding="5px">
	<tr>
		<th width="20px">#</th>
		<th width="100px">NIK</th>
		<th width="300px">Nama Lengkap</th>
		<th>Departemen</th>
		<th>Jabatan</th>
		<th>Tanggal Masuk</th>
	</tr>
	<?php $count = (1+$this->uri->segment(3)); ?>
	<?php foreach ($karyawan as $data): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $data['nik'] ?></td>
			<td><?php echo $data['nama_depan']. ' ' .$data['nama_belakang'] ?></td>
			<td><?php echo $data['nama_departemen'] ?></td>
			<td><?php echo $data['nama_jabatan'] ?></td>
			<td><?php echo $data['join_date'] ?></td>
		</tr>
	<?php endforeach ?>
</table>
<script type="text/javascript">window.print()</script>