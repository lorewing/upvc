<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?= $site_title; ?> CMS</title>
        
		<link rel="stylesheet" href="<?php echo base_url(); ?>admin_view/css/app.css" />
		<script src="<?php echo base_url(); ?>admin_view/bower_components/modernizr/modernizr.js"></script>
	</head>
	<body>
	
	<div id="wrapper" class="row">
	
		<div class="row">	
	
			<div id="header" class="columns large-4 large-centered">
			
				<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>admin_view/images/lorewing_logo.jpg"></a>
			
			</div>
		
		</div>
		
		<div id="login_form" class="large-8 large-centered columns">
		
			<fieldset>
			
				<legend>Lorewing CMS</legend>
					
					<?php
					
						echo validation_errors('<p class=\'error\'>');
						
					?>
				
					<?php echo form_open('/admincms/login/validate_credentials'); ?>
					
					<?php echo form_input(array('placeholder' => 'Email', 'type' => 'text', 'name' => 'email', 'value' => set_value('email') )); ?>
					
					<?php echo form_input(array('placeholder' => 'Password', 'type' => 'password', 'name' => 'password')); ?>
					
                    <input name="remember_me" value="remember_me" type="checkbox" /> <label>Remember Me?</label>
								
                                
					<?php echo form_submit(array('value' => 'Login', 'class' => 'button radius right', 'name' => 'login')); ?>
			
			</fieldset>
		
		</div>
		
		<div class="row">

			<footer class="large-8 large-centered columns">
			
				<p class="right">Content Management System Powered by <a href="http://www.lorewing.com" target="_blank">Lorewing Web Design Inc.</a></p>
			
			</footer>
		
		</div>
		
	</div>
	
	<script src="<?php echo base_url(); ?>admin_view/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_view/bower_components/foundation/js/foundation.min.js"></script>
	<script src="<?php echo base_url(); ?>admin_view/js/app.js"></script>
	
	</body>
</html>
