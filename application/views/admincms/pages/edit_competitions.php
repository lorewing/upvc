<?php $this->load->view("admincms/includes/top.php"); ?>

	<div id="content_container" class="row">
		
		<div class="columns large-12">
		
			<p>Welcome to the <?= $this->config->item('site_title'); ?> Content Management System.</p>
			
		
		</div>
        
        	<div id="content_container" class="row">
		
		
		
		<div id="main_content_section" class="columns large-12 left">
		
			<div id="form_add">
		
				<fieldset>
				
					<legend>Edit Competitions</legend>
					
					 <?php foreach($rows as $r) : ?>
                    	  <?php 
								$page_id = $r->page_id;
								$category_id = $r->category_id;
								$title_ar = $r->title_ar;
								$desc_ar = $r->desc_ar;
								$pdf_name = $r->pdf_name;
								$active = $r->active;
								$image_name = $r->image_name;
								$image_thumb = $r->image_thumb;
								$arrange = $r->arrange;
								
								
							?>
                    	  
                    	  <?php endforeach; ?>
                   		<?php echo form_open_multipart('/admincms/pages/update_competitions'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
				  
						
                  <label>Title*</label>
					
                     <?php echo form_input(array('name' => 'title_ar', 'id' => 'title_ar', 'placeholder' => 'Page Title', 'value' => $title_ar)); ?>
						
                 <label>Section*</label>
                       		<select name="category_id">
                            <option value=""> Please Select your Section</option>
                            <?php
                        	$query = $this->db->get('category');
							
							
									foreach ($query->result() as $row)
									
									{?>
										 <option value="<?php echo $row->category_id;?>" <?php if ($row->category_id === $category_id) echo 'selected="selected"' ?>><?php echo $row->category_name;?></option>	
                                         		
									<?php } // end for each
							?>
							</select>
					   
                       <br />
                  <label>Description</label>
						<?php echo form_textarea(array('name' => 'desc_ar', 'id' => 'desc_ar', 'placeholder' => 'Description Arabic', 'value' => $desc_ar)); ?>

				<br />
						
                        
                        <label>Arrange</label>
						<?php echo form_input(array('name' => 'arrange', 'id' => 'arrange', 'placeholder' => 'Arrange', 'value' => $arrange)); 	?>
                         
                         <?php echo form_checkbox('active', '1', $active);?>
						 <label>Active </label>
                         
				       <input name="page_id" type="hidden" value="<?php echo $page_id?>" />

						
						<?php echo form_submit(array('name' => 'edit_post','id' => 'edit_post', 'value' => 'Edit Competitions', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
                        
                       
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
