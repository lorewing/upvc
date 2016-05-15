<?php $this->load->view("admincms/includes/top.php"); ?>

	<div id="content_container" class="row">
		
		<div class="columns large-12">
		
			<p>Welcome to the <?= $this->config->item('site_title'); ?> Content Management System.</p>
			
		
		</div>
        
        	<div id="content_container" class="row">
		
		
		
		<div id="main_content_section" class="columns large-12 left">
		
			<div id="form_add">
		
				<fieldset>
				
					<legend>Edit Category</legend>
					
					 <?php foreach($rows as $r) : ?>
                    	  <?php 
								$category_id = $r->category_id;
								$sub_cat = $r->sub_cat;
								$category_name = $r->category_name;
								$meta_keywords = $r->meta_keywords;
								$meta_description = $r->meta_description;
								$category_cover = $r->category_cover;
								$arrange = $r->arrange;
								$active = $r->active;
								
							?>
                    	  
                    	  <?php endforeach; ?>
                   		<?php echo form_open_multipart('/admincms/pages/update_category'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
				  
						
                  <label>Category Title*</label>
						<?php echo form_input(array('name' => 'category_name_ar', 'id' => 'category_name_ar', 'placeholder' => 'Category Title Arabic', 'value' => $category_name )); ?>
						
                  <img src="<?php echo base_url(); ?>private/pages/<?= $category_cover; ?>" width="250" height="250"></p>
                    	<p>
                    	  <?php echo form_upload(array('name' => 'userfile', 'id' => 'image'));	?>
                   
                    <br />
						
                        <label>Category*</label>
                       		<select name="sub_cat">
                            <option value="0"> قسم رئيسي</option>
                            <?php
							
							$query = $this->db->get('category');
							
							
									foreach ($query->result() as $row)
									{?>
										 <option value="<?= $row->category_id;?>" <?php if ($row->category_id === $sub_cat) echo 'selected="selected"'?>><?= $row->category_name;?></option>				
									<?php } // end for each
							?>
							</select>
                            
                            <br />
                        
                        <label>Arrange</label>
						<?php echo form_input(array('name' => 'arrange', 'id' => 'arrange', 'placeholder' => 'Arrange', 'value' => $arrange)); 	?>
					   
             
					
                  <label><br />
                  Meta Keywords</label>
						<?php echo form_input(array('name' => 'meta_keywords', 'id' => 'meta_keywords', 'placeholder' => 'Meta Keywords', 'value' => $meta_keywords)); ?>
						
                  <label>Meta Description</label>
						<?php echo form_textarea(array('name' => 'meta_description', 'id' => 'meta_description', 'placeholder' => 'Meta Description', 'value' => $meta_description)); ?>	
                          
                  
                          
             		  	<?php echo form_checkbox('active', '1', $active);?>
						 <label>Active </label>
                         
				       <input name="category_id" type="hidden" value="<?=$category_id?>" />

						
						<?php echo form_submit(array('name' => 'edit_post','id' => 'edit_post', 'value' => 'Edit Post', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
                        
                       
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
