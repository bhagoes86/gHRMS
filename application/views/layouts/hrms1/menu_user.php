<div id="menu">
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container" style="width: auto;">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="nav-collapse">
					<ul class="nav">
						<li><?php echo anchor('home', '<i class="icon-home icon-white"></i>'); ?></li>
						<li><?php echo anchor('home/search', 'Search'); ?></li>
					</ul>
					<ul class="nav pull-right">
						<li class="divider-vertical"></li>
						<li><div><?php echo anchor('login', 'Login', array('class'=>"btn btn-danger btn-small")); ?></div></li>

					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div>
</div>