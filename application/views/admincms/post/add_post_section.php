<?php $this->load->view("admincms/includes/top.php"); ?>

	<div id="content_container" class="row">
		
		<div class="columns large-12">
		
			<p>Welcome to the <?= $this->config->item('site_title'); ?> Content Management System.</p>
			
		
		</div>
        
        	<div id="content_container" class="row">
		
		
		
		<div id="main_content_section" class="columns large-12 left">
		
			<div id="form_add">
		
				<fieldset>
				
					<legend>Add Section</legend>
					
				
                   		<?php echo form_open_multipart('/admincms/post/add_post_section'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
				  <label>Section Title Arabic*</label>
						<?php echo form_input(array('name' => 'section_name_ar', 'id' => 'section_name_ar', 'placeholder' => 'Section Title Arabic', 'value' => set_value('section_name_ar'))); ?>
						
                  <label>Section Title English</label>
						<?php echo form_input(array('name' => 'section_name_en', 'id' => 'section_name_en', 'placeholder' => 'Section Title English', 'value' => set_value('section_name_en'))); ?>
						
                        <label>Section Cover Image</label>
                  <?php echo form_upload(array('name' => 'userfile', 'id' => 'image'));	?>


					   
                  <br />
                  <label>Section Description Arabic</label>
						<?php echo form_textarea(array('name' => 'section_desc_ar', 'id' => 'section_desc_ar', 'placeholder' => 'Section Description', 'value' => set_value('section_desc_ar'))); ?>
						
                  <label><br />
                  Section Description English</label>
						<?php echo form_textarea(array('name' => 'section_desc_en', 'id' => 'section_desc_en', 'placeholder' => 'Section Description', 'value' => set_value('section_desc_en'))); ?>
					
                  <label><br />
                  Meta Keywords</label>
						<?php echo form_input(array('name' => 'meta_keywords', 'id' => 'meta_keywords', 'placeholder' => 'Section Title Arabic', 'value' => set_value('meta_keywords'))); ?>
						
                  <label>Meta Description</label>
						<?php echo form_textarea(array('name' => 'meta_description', 'id' => 'meta_description', 'placeholder' => 'Meta Description', 'value' => set_value('meta_description'))); ?>
					 
                        
                  <label><br />
                  Related Tag</label>
						<?php echo form_input(array('name' => 'related_tag', 'id' => 'related_tag', 'placeholder' => 'Industries Arrange', 'value' => set_value('related_tag'))); ?>
						
						<?php
						
						echo form_submit(array('name' => 'add_project','id' => 'add_project', 'value' => 'Add Section', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
				
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
