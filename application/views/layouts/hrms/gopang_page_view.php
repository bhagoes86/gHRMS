<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
global $template;
$assets = base_url(). "application/views/layouts/" .$template. "/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>HRM System : Human Resources Management System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="human resources management sistem">
	<meta name="author" content="">

	<!-- Le styles -->
	<link rel="stylesheet" href="<?php echo $assets ?>bootstrap/assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo $assets ?>bootstrap/assets/css/datepicker.css">
	<!-- <link href="bootstrap/assets/css/bootstrap.css" rel="stylesheet"> -->
	<script src="<?php echo $assets ?>js/jquery-1.7.2.min.js"></script>
	<script src="<?php echo $assets ?>js/jquery.validate.min.js"></script>
	<script src="<?php echo $assets ?>bootstrap/assets/js/bootstrap-transition.js"></script>
	<script src="<?php echo $assets ?>bootstrap/assets/js/bootstrap-alert.js"></script>
	<script src="<?php echo $assets ?>bootstrap/assets/js/bootstrap-modal.js"></script>
	<script src="<?php echo $assets ?>bootstrap/assets/js/bootstrap-dropdown.js"></script>
	<script src="<?php echo $assets ?>bootstrap/assets/js/bootstrap-scrollspy.js"></script>
	<script src="<?php echo $assets ?>bootstrap/assets/js/bootstrap-tab.js"></script>
	<script src="<?php echo $assets ?>bootstrap/assets/js/bootstrap-tooltip.js"></script>
	<script src="<?php echo $assets ?>bootstrap/assets/js/bootstrap-popover.js"></script>
	<script src="<?php echo $assets ?>bootstrap/assets/js/bootstrap-button.js"></script>
	<script src="<?php echo $assets ?>bootstrap/assets/js/bootstrap-collapse.js"></script>
	<script src="<?php echo $assets ?>bootstrap/assets/js/bootstrap-carousel.js"></script>
	<script src="<?php echo $assets ?>bootstrap/assets/js/bootstrap-typeahead.js"></script>
	<script src="<?php echo $assets ?>bootstrap/assets/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo $assets ?>js/hrms.js"></script>
	<style type="text/css">
	body { padding-top: 60px; padding-bottom: 40px; }
	</style>
	<link href="<?php echo $assets ?>bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="<?php echo $assets ?>bootstrap/assets/images/favicon.ico">
		<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/images/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/images/apple-touch-icon-114x114.png">
	</head>
	<body>
		<div class="navbar navbar-fixed-top navbar-inverse">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#">HRM System</a>
					<div class="nav-collapse" data-toggle="nav">
						<ul class="nav">
							<li class="active"><a href="/">Dashboard</a></li>
							<li class="dropdown clearfix">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Sistem<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li class="dropdown-submenu">
										<a tabindex="-1" href="#">Transaksi</a>
										<ul class="dropdown-menu">
											<li><?php echo anchor('tunjangan/index', 'Tunjangan'); ?></li>
											<li><?php echo anchor('potongan/index', 'Potongan'); ?></li>
											<li><?php echo anchor('jenis_cuti/index', 'Jenis Cuti'); ?></li>
										</ul>
									</li>
									<li class="divider"></li>
									<li><?php echo anchor('pendidikan/index', 'Pendidikan'); ?></li>
									<li><?php echo anchor('agama/index', 'Agama'); ?></li>
									<li><?php echo anchor('departemen/index', 'Departemen'); ?></li>
									<li><?php echo anchor('cabang/index', 'Cabang'); ?></li>
									<li><?php echo anchor('jabatan/index', 'Jabatan'); ?></li>
									<li><?php echo anchor('status/index', 'Status Karyawan'); ?></li>
								</ul>
							</li>
							<li class="dropdown clearfix">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">HRD<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><?php echo anchor('karyawan/index', 'Informasi Karyawan'); ?></li>
									<li class="divider"></li>
									<li><?php echo anchor('karyawan/tambah', 'Tambah Karyawan'); ?></li>
									<li><?php echo anchor('karyawan/print_karyawan', 'Report'); ?></li>
								</ul>
							</li>
							<li><?php echo anchor('cuti/index', 'Cuti'); ?></li>
							<li><?php echo anchor('presensi/index', 'Presensi'); ?></li>
							<li class="dropdown clearfix">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Penggajian<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><?php echo anchor('penggajian/index', 'List Gaji'); ?></li>
									<li><?php echo anchor('penggajian/input_gaji', 'Input Gaji'); ?></li>
								</ul>
							</li>
						</ul>
						<ul class="nav pull-right">
							<li class="divider-vertical"></li>

							<li>
								<div>
									<a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
										<i class="icon-user"></i>
										Septian
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
									<!-- <li>
										<a href="#">Profile</a>
									</li> -->
									<!-- <li class="divider"></li> -->
									<li>
										<?php echo anchor('login/logout', 'Logout'); ?>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>

	<div class="container-fluid">

		<div class="row-fluid">
			<?php $this->load->view($view); ?>
		</div><!--/row-->
		<hr>
		<footer>
			<p class="pull-left">&copy; 2012 <a href="#">Mariza.co.id</a> All right no reserved</p>
			<p class="pull-right"><strong>HRM System</strong> v.1.00 alpha</p>
		</footer>
	</div><!--/.fluid-container-->

	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	
</body>
</html>