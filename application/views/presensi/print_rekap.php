<html>
<head>
	<title>Print rekap</title>
	<style type="text/css">
		body {
			font-size:10px;
			font-family: tahoma;
		}
		table {font-size:10px}
	</style>
</head>
<body>
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
<h4>Rekap Presensi</h4>
<?php 
	$dari_save = $dari;
	$sampai_save = $sampai;
	$dari_save2 = $dari;
	$sampai_save2 = $sampai;
 ?>
<p>Dari Tanggal: <?php echo $dari_save ?></p>
<p>Sampai Tanggal: <?php echo $sampai_save ?></p>


<table border="1px" cellspacing="0px" cellpadding="5px">
	<tr>
		<th width="20px">No</th>
		<th width="80px">NIK</th>
		<th width="100px">Nama</td>
		<?php 
			while (strtotime($dari_save) <= strtotime($sampai_save)) {
				echo "<th width='50px'>$dari_save</th>";
				$dari_save = date ("Y-m-d", strtotime("+1 day", strtotime($dari_save)));
			}

		 ?>
	</tr>

	<?php $count = 1; if (count($data_presensi) > 0): ?>
		<?php foreach ($data_presensi as $presensi): ?>
		<tr>
			<td><?php echo $count++ ?></td>
			<td><?php echo $presensi['karyawan_id'] ?></td>
			<td><?php echo $presensi['nama_depan'].' '.$presensi['nama_belakang'] ?></td>
			<?php 
				while (strtotime($dari_save2) <= strtotime($sampai_save2)) {
					if ($presensi['tanggal'] == $dari_save2) {
						echo "<td>".$presensi['jam_masuk'].' '.$presensi['jam_keluar']."</td>";
					} else {
						echo "<td></td>";
					}
					$dari_save2 = date ("Y-m-d", strtotime("+1 day", strtotime($dari_save2)));
				}

			 ?>
		</tr>
		<?php endforeach ?>
	<?php else: ?>
		<tr>
			<td colspan="6"><i>Belum ada data</i></td>
		</tr>
	<?php endif ?>
	
</table>

</body>
</html>
