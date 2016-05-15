<?php $this->load->view("admincms/includes/top.php"); ?>

	<div id="content_container" class="row">
		
		<div class="columns large-12">
		
			<p>Welcome to the <?= $this->config->item('site_title'); ?> Content Management System.</p>
			
		
		</div>
        
        	<div id="content_container" class="row">
		
		
		
		<div id="main_content_category" class="columns large-12 left">
		
			<div id="form_add">
		
				<fieldset>
				
					<legend>Add Category</legend>
					
				
                   		<?php echo form_open_multipart('/admincms/pages/add_page_category'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
				  <label>Category Title*</label>
						<?php echo form_input(array('name' => 'category_name_ar', 'id' => 'category_name_ar', 'placeholder' => 'Category Title Arabic', 'value' => set_value('category_name_ar'))); ?>
						
                  <?php /*?><label>Category Title English</label>
						<?php echo form_input(array('name' => 'category_name_en', 'id' => 'category_name_en', 'placeholder' => 'Category Title English', 'value' => set_value('category_name_en'))); ?><?php */?>
						
                        <label>Category Cover Image</label>
                  <?php echo form_upload(array('name' => 'userfile', 'id' => 'image'));	?>

				<br />
                
                <label>Category*</label>
                       		<select name="sub_cat">
                            <option value="0"> قسم رئيسي</option>
                            <?php
                        	$query = $this->db->get('category');
							
							
									foreach ($query->result() as $row)
									
									{?>
										 <option value="<?= $row->category_id;?>"><?= $row->category_name;?></option>				
									<?php } // end for each
							?>
							</select>
                            
                            <br />
                        <label>Arrange</label>
						<?php echo form_input(array('name' => 'arrange', 'id' => 'arrange', 'placeholder' => 'Arrange', 'value' => set_value('arrange'))); 	?>
					   
              <?php /*?>    <br />
                  <label>Category Description Arabic</label>
						<?php echo form_textarea(array('name' => 'category_desc_ar', 'id' => 'category_desc_ar', 'placeholder' => 'Category Description', 'value' => set_value('category_desc_ar'))); ?>
						
                  <label><br />
                  Category Description English</label>
						<?php echo form_textarea(array('name' => 'category_desc_en', 'id' => 'category_desc_en', 'placeholder' => 'Category Description', 'value' => set_value('category_desc_en'))); ?><?php */?>
					
                  <label><br />
                  Meta Keywords</label>
						<?php echo form_input(array('name' => 'meta_keywords', 'id' => 'meta_keywords', 'placeholder' => 'Meta Keywords', 'value' => set_value('meta_keywords'))); ?>
						
                  <label>Meta Description</label>
						<?php echo form_textarea(array('name' => 'meta_description', 'id' => 'meta_description', 'placeholder' => 'Meta Description', 'value' => set_value('meta_description'))); ?>
					 
                        
                  
						
						<?php
						
						echo form_submit(array('name' => 'add_project','id' => 'add_project', 'value' => 'Add Category', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
				
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
