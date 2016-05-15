<?php $this->load->view("admincms/includes/top.php"); ?>

	<div id="content_container" class="row">
		
		<div class="columns large-12">
		
			<p>Welcome to the <?= $this->config->item('site_title'); ?> Content Management System.</p>
			
		
		</div>
        
        	<div id="content_container" class="row">
		
		
		
		<div id="main_content_section" class="columns large-12 left">
		
			<div id="form_add">
		
				<fieldset>
				
					<legend>Add Post</legend>
					
				
                   		<?php echo form_open_multipart('/admincms/post/add_post'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
				  <label>Title Arabic*</label>
						<?php echo form_input(array('name' => 'title_ar', 'id' => 'title_ar', 'placeholder' => 'Title Arabic', 'value' => set_value('title_ar'))); ?>
						
                  <?php /*?><label>Title English</label>
						<?php echo form_input(array('name' => 'title_en', 'id' => 'title_en', 'placeholder' => 'Title English', 'value' => set_value('title_en'))); ?><?php */?>
						
                        <label>Section Cover Image</label>
                  <?php echo form_upload(array('name' => 'userfile', 'id' => 'image'));	?>

				<?php /*?><label>Section*</label>
                       		<select name="section_id">
                            <option value=""> Please Select your Section</option>
                            <?php
                        	$query = $this->db->get('post_section');
							
							
									foreach ($query->result() as $row)
									
									{?>
										 <option value="<?= $row->section_id;?>"><?= $row->section_name_ar;?></option>				
									<?php } // end for each
							?>
							</select><?php */?>
					   
                  <br />
                  <label>Description Arabic</label>
						<?php echo form_textarea(array('name' => 'desc_ar', 'id' => 'desc_ar', 'placeholder' => 'Description Arabic', 'value' => set_value('desc_ar'))); ?>
						
                  <?php /*?><label><br />
                  Description English</label>
						<?php echo form_textarea(array('name' => 'desc_en', 'id' => 'desc_en', 'placeholder' => 'Description English', 'value' => set_value('desc_en'))); ?><?php */?>
					
                     
                  <label><br />
                  Related Tag</label>
						<?php echo form_input(array('name' => 'related_tag', 'id' => 'related_tag', 'placeholder' => 'Industries Arrange', 'value' => set_value('related_tag'))); ?>
                        
                         <input type="checkbox" id="show_on_silder" name="show_on_silder" value="1" class="" <?php echo set_checkbox('show_on_silder', '1'); ?>>               

                          <label>Show On Slider </label>
				
                	 <input type="checkbox" id="active" name="active" value="1" checked="checked" class="" <?php echo set_checkbox('active', '1'); ?>>               

                          <label>Active </label>
						<?php
						
						echo form_submit(array('name' => 'add_project','id' => 'add_project', 'value' => 'Add Post', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
                        
                       
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
