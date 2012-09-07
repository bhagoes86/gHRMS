<div id="login-form" class="well" style="margin:100px auto;text-align:center;width:300px">
	<h2>Login Form</h2>
	<hr>
	<?php echo validation_errors(); ?>
	<?php echo form_open('login/verify'); ?>
		<fieldset>
			<div class="control-group">
				<input type="text" name="username" placeholder="Username">
			</div>
			<div class="control-group">
				<input type="password" name="password" placeholder="Password">
			</div>
			<button class="btn btn-primary pull-right" type="submit">Sign in</button>
		</fieldset>
	<?php echo form_close() ?>
</div>