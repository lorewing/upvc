<?php $this->load->view("admincms/includes/top.php"); ?>

	<div id="content_container" class="row">
		
		<div class="columns large-12">
		
			<p>Welcome to the <?= $this->config->item('site_title'); ?> Content Management System.</p>
			
		
		</div>
        
        	<div id="content_container" class="row">
		
		
		
		<div id="main_content_category" class="columns large-12 left">
		
			<div id="form_add">
		
				<fieldset>
				
					<legend>Add Page</legend>
					
				
                   		<?php echo form_open_multipart('/admincms/pages/add_page'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
				  <label>Page Title*</label>
						<?php echo form_input(array('name' => 'title_ar', 'id' => 'title_ar', 'placeholder' => 'Page Title', 'value' => set_value('title_ar'))); ?>
						
                 <label>Section*</label>
                       		<select name="category_id">
                            <option value=""> Please Select your Section</option>
                            <?php
                        	$query = $this->db->get('category');
							
							
									foreach ($query->result() as $row)
									
									{?>
										 <option value="<?= $row->category_id;?>"><?= $row->category_name;?></option>				
									<?php } // end for each
							?>
							</select>
					   
                  <br />
                  <label>Upload PDF</label>
                  <?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile'));	?>

				<br />
						
                        <label>Page Cover Image</label>
                  <?php echo form_upload(array('name' => 'userfile2', 'id' => 'image'));	?>

				<br />
                
                
                        <label>Arrange</label>
						<?php echo form_input(array('name' => 'arrange', 'id' => 'arrange', 'placeholder' => 'Arrange', 'value' => set_value('arrange'))); 	?>
					   
             
					
                 
                        <input type="checkbox" id="active" name="active" value="1" checked="checked" class="" <?php echo set_checkbox('active', '1'); ?>>               

                          <label>Active </label>
						
                  
						
						<?php
						
						echo form_submit(array('name' => 'add_project','id' => 'add_project', 'value' => 'Add Page', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
				
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
