<?php $this->load->view("admincms/includes/top.php"); ?>

	<div id="content_container" class="row">
		
		<div class="columns large-12">
		
			<p>Welcome to the <?= $this->config->item('site_title'); ?> Content Management System.</p>
			
			
		</div>
        
        	<div id="content_container" class="row">
		
		
		
		<div id="main_content_section" class="columns large-12 left">
			<?php 
								
								if(!empty($update_record)){
							echo $update_record;
							}
					?> 
			<div id="form_add">
		
				<fieldset>
				
					<legend>Edit User - </legend>
						
					
						
                    
                    	<p>
                    	  <?php foreach($rows as $r) : ?>
                    	  <?php 
								$user_id = $r->user_id;
								$user_first_name = $r->user_first_name;
								$user_last_name = $r->user_last_name;
								$username = $r->username;
								$password = $r->password;
								$user_email = $r->user_email;
								$active = $r->active;
								$role = $r->role;
								
							?> 
                    	  
                    	  <?php endforeach; ?>
                    	  
                    	  
                    	  <?php echo form_open('/admincms/users/update_user/'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
                        
                                            	  <input name="user_id" type="hidden" value="<?=$user_id?>" />

                    	 					<label>First Name*</label>
						<?php echo form_input(array('name' => 'user_first_name', 'id' => 'user_first_name', 'placeholder' => 'First Name', 'value' => $user_first_name)); ?>
						
                        <label>Last Name</label>
						<?php echo form_input(array('name' => 'user_last_name', 'id' => 'user_last_name', 'placeholder' => 'Last Name', 'value' => $user_last_name)); ?>
						
                        <label>User Name*</label>
						<?php echo form_input(array('name' => 'username', 'id' => 'username', 'placeholder' => 'User Name', 'value' => $username)); ?>
						
                        <label>Password*</label>
						<?php echo form_password(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Password')); ?>
						
                        
                        <label>User Email*</label>
						<?php echo form_input(array('name' => 'user_email', 'id' => 'user_email', 'placeholder' => 'User Email', 'value' => $user_email)); ?>
				
                       <label>Permissions*</label>
                       
						<?php
							 $options=array('administrator'=>'Administrator','power_user'=>'Power User','director'=>'Director','staff'=>'Staff','visitors'=>'Visitors');
								// $Industries  is for selected value
								echo form_dropdown('Permissions', $options , $role );
						?>
                        
                         <label>Active</label>
                         
                        <?php 
						
						echo form_checkbox('active', '1',$active); ?>
                        
                       
						<?php echo form_submit(array('name' => 'edit_portfolio','id' => 'edit_portfolio', 'value' => 'Edit Portfolio', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
				
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
