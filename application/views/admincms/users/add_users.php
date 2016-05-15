<?php $this->load->view("admincms/includes/top.php"); ?>

	<div id="content_container" class="row">
		
		<div class="columns large-12">
		
			<p>Welcome to the <?= $this->config->item('site_title'); ?> Content Management System.</p>
			
		
		</div>
        
        	<div id="content_container" class="row">
		
		
		
		<div id="main_content_section" class="columns large-12 left">
		
			<div id="form_add">
		
				<fieldset>
				
					<legend>Add User</legend>
                    
					
				
                   		<?php echo form_open('/admincms/users/add_users');
						
						 echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?> 


                        
						
						
                        
                        
						<label>First Name*</label>
						<?php echo form_input(array('name' => 'user_first_name', 'id' => 'user_first_name', 'placeholder' => 'First Name', 'value' => set_value('user_first_name'))); ?>
						
                        <label>Last Name</label>
						<?php echo form_input(array('name' => 'user_last_name', 'id' => 'user_last_name', 'placeholder' => 'Last Name', 'value' => set_value('user_last_name'))); ?>
						
                        <label>User Name*</label>
						<?php echo form_input(array('name' => 'username', 'id' => 'username', 'placeholder' => 'User Name', 'value' => set_value('username'))); ?>
						
                        <label>Password*</label>
						<?php echo form_password(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Password', 'value' => set_value('password'))); ?>
						
                        
                        <label>User Email*</label>
						<?php echo form_input(array('name' => 'user_email', 'id' => 'user_email', 'placeholder' => 'User Email', 'value' => set_value('user_email'))); ?>
						
                       
                       <label>Permissions*</label>
                       
						<?php
							 $options=array('administrator'=>'Administrator','power_user'=>'Power User','director'=>'Director','staff'=>'Staff','visitors'=>'Visitors');
								// $Industries  is for selected value
								echo form_dropdown('Permissions', $options , 'staff' );
						?>

						<?php
						
						echo form_submit(array('name' => 'add_user','id' => 'add_user', 'value' => 'Add User', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
				
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
