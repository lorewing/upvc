<?php $this->load->view("admincms/includes/top.php"); ?>

	<div id="content_container" class="row">
		
		<div class="columns large-12">
		
			<p>Welcome to the <?= $this->config->item('site_title'); ?> Content Management System.</p>
			
		
		</div>
        
        	<div id="content_container" class="row">
		
		
		
		<div id="main_content_section" class="columns large-12 left">
		
			<div id="form_add">
		
				<fieldset>
				
					<legend>Add Main Menu</legend>
                    
                   		<?php echo form_open('/admincms/menus/add_main_menu');
						
						 echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?> 

						<label>Menu Name*</label>
						<?php echo form_input(array('name' => 'title', 'id' => 'title', 'placeholder' => 'Title', 'value' => set_value('title'))); ?>
						
                        
                        
                        <label>URL*</label>
						<?php echo form_input(array('name' => 'url', 'id' => 'url', 'placeholder' => 'URL', 'value' => set_value('url'))); ?>
						
                        <label>Target</label>
                       
						<?php
							 $options=array('_blank'=>'Blank','new'=>'New Windows','_self'=>'Same Page');
								// $Industries  is for selected value
								echo form_dropdown('target', $options , '_self' );
						?>
                        
                        
                        <label>Order</label>
						<?php echo form_input(array('name' => 'order', 'id' => 'order', 'placeholder' => 'order', 'value' => set_value('order'))); ?>
						
                        <label>class_name</label>
						<?php echo form_input(array('name' => 'class_name', 'id' => 'class_name', 'placeholder' => 'Class Name', 'value' => set_value('class_name'))); ?>
						
 						
                        <label>Active</label> 
                        <?php echo form_checkbox('is_active', '1',TRUE); ?>
						
						<?php
						echo form_submit(array('name' => 'add_menu','id' => 'add_menu', 'value' => 'Add menu', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
				
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
