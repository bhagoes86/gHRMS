<h3>Penggajian</h3>
<hr>
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