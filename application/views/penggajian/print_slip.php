<html>
<head>
	<title>Print Slip Gaji</title>
	
	<style type="text/css">
	body {
		font-family: tahoma;
	}
	</style>
</head>
<body>
<div style="width:600px;border:1px solid black;padding:10px;">
	<div id="head" style="text-align:center"><?php echo $bulan ?> <?php echo $tahun ?></div>
	<hr>
	<div id="info" style="border-bottom:1px solid black">
		<p>Nama Pegawai: <?php echo $nama_karyawan ?><br/>
		Bagian: <?php echo $nama_jabatan ?>
		</p>
	</div>
	<div id="tunjangan" style="padding-bottom:5px;border-bottom:1px solid black">
		<div><i>Rincian :</i></div>
		<div style="margin-right:40px;">
			Total Tunjangan : Rp <?php echo $total_tunjangan ?><br/>
			Total Potongan : Rp  <?php echo $total_potongan ?><br>
			Gaji Pokok	: Rp <?php echo $gapok ?> <br>

		</div>
		
	</div>
	<div id="total" style="text-align:center;font-weight:bold;border-bootom:1px solid black;">TOTAL GAJI : Rp <?php echo $total_gaji ?></div>
	<div id="paraf" style="margin-left:400px">
		<div style="width:200px;text-align:center;">
			Bagian Keuangan
			<div style="height:50px"></div>
			(.........................)
		</div>
	</div>
</div>
<script type="text/javascript">window.print()</script>
</body>
</html>