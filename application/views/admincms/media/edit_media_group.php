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
								$group_id = $r->group_id;
								$group_name = $r->group_name;
								$group_type = $r->group_type;
								$album_cover = $r->album_cover;
								$arrange = $r->arrange;
								$active = $r->active;
								
							?>
                    	  
                    	  <?php endforeach; ?>
                   		<?php echo form_open_multipart('/admincms/media/update_media_group'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
				  
						
                        <label>Media Group Title</label>
						<?php echo form_input(array('name' => 'group_name', 'id' => 'group_name', 'placeholder' => 'Media Group Title', 'value' => $group_name)); ?>
						
                  <img src="<?php echo base_url(); ?>private/media/<?= $album_cover; ?>" width="250" height="250"></p>
                    	<p>
                    	  <?php echo form_upload(array('name' => 'userfile', 'id' => 'image'));	?>
                   
                    <br />
						
                        <label>Type*</label>
                       
						<?php
							 $options=array('gallery'=>'Photo Gallery','pdf'=>'PDF','audio'=>'Audio','xls'=>'Excel File','doc'=>'Word file','file'=>'file','video'=>'Video','zip'=>'ZIP File'  );
								// $Industries  is for selected value
								echo form_dropdown('type', $options , $group_type );
						?>
                        
                       
                        
                        <label>Arrange</label>
						<?php echo form_input(array('name' => 'arrange', 'id' => 'arrange', 'placeholder' => 'Arrange', 'value' => $arrange)); 	?>
					   
             
					
                  
                          
                  
                          
             		  	<?php echo form_checkbox('active', '1', $active);?>
						 <label>Active </label>
                         
				       <input name="group_id" type="hidden" value="<?=$group_id?>" />

						
						<?php echo form_submit(array('name' => 'edit_post','id' => 'edit_post', 'value' => 'Edit Post', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
                        
                       
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
