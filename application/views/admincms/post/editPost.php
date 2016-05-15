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
					
					 <?php foreach($rows as $r) : ?>
                    	  <?php 
								$title_ar = $r->title_ar;
								$title_en = $r->title_en;
								$image_name = $r->image_name;
								$section_id = $r->section_id;
								$desc_ar = $r->desc_ar;
								$desc_en = $r->desc_en;
								$active = $r->active;
								$show_on_silder = $r->show_on_silder;
								$related_tag = $r->related_tag;
								$post_id = $r->post_id;
								
							?>
                    	  
                    	  <?php endforeach; ?>
                   		<?php echo form_open_multipart('/admincms/post/update_post'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
				  <label>Title Arabic*</label>
						<?php echo form_input(array('name' => 'title_ar', 'id' => 'title_ar', 'placeholder' => 'Title Arabic', 'value' => $title_ar)); ?>
						
                 <?php /*?> <label>Title English</label>
						<?php echo form_input(array('name' => 'title_en', 'id' => 'title_en', 'placeholder' => 'Title English', 'value' => $title_en)); ?><?php */?>
						
                          <img src="<?php echo base_url(); ?>private/post/<?= $image_name; ?>" width="250" height="250"></p>
                    	<p>
                    	  <?php echo form_upload(array('name' => 'userfile', 'id' => 'image'));	?>
                   
                    <br />
                  <label>Description Arabic</label>
						<?php echo form_textarea(array('name' => 'desc_ar','class' => 'ckeditor', 'id' => 'desc_ar', 'placeholder' => 'Description Arabic', 'value' => $desc_ar)); ?>
                        

						
                 <?php /*?> <label><br />
                  Description English</label>
						<?php echo form_textarea(array('name' => 'desc_en','class' => 'ckeditor', 'id' => 'desc_en', 'placeholder' => 'Description English', 'value' => $desc_en)); ?>
					

				<label>Section*</label>
                       		<select name="section_id">
                            <option value=""> Please Select your Section</option>
                            <?php
                        	$query = $this->db->get('post_section');
							
							
									foreach ($query->result() as $row)
									{?>
										 <option value="<?= $row->section_id;?>" <?php if ($row->section_id === $section_id) echo 'selected="selected"'?>><?= $row->section_name_ar;?></option>				
									<?php } // end for each
							?>
							</select><?php */?>
                 
                     
                  <label><br />
                  Related Tag</label>
						<?php echo form_input(array('name' => 'related_tag', 'id' => 'related_tag', 'placeholder' => 'Industries Arrange', 'value' => $related_tag)); ?>
                        
             		  	  <?php echo form_checkbox('show_on_silder', '1', $show_on_silder);?>
                          <label>Show On Slider </label>
                          <br/>
                          
             		  	<?php echo form_checkbox('active', '1', $active);?>
						 <label>Active </label>
                         
				       <input name="post_id" type="hidden" value="<?=$post_id?>" />

						
						<?php echo form_submit(array('name' => 'edit_post','id' => 'edit_post', 'value' => 'Edit Post', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
                        
                       
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
