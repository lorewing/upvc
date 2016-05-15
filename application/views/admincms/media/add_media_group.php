<?php $this->load->view("admincms/includes/top.php"); ?>

	<div id="content_container" class="row">
		
		<div class="columns large-12">
		
			<p>Welcome to the <?= $this->config->item('site_title'); ?> Content Management System.</p>
			
		
		</div>
        
        	<div id="content_container" class="row">
		
		
		
		<div id="main_content_section" class="columns large-12 left">
		
			<div id="form_add">
		
				<fieldset>
				
					<legend>Add Media Group</legend>
					
				
                   		<?php echo form_open_multipart('/admincms/media/add_media_group'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
						<label>Media Group Title</label>
						<?php echo form_input(array('name' => 'group_name', 'id' => 'group_name', 'placeholder' => 'Media Group Title', 'value' => set_value('group_name'))); ?>
						
                       <?php /*?> <label>Media Group Title English</label>
						<?php echo form_input(array('name' => 'group_name_en', 'id' => 'group_name_en', 'placeholder' => 'Media Group Title', 'value' => set_value('group_name_en'))); ?><?php */?>
						
                  <label>Album Cover Image</label>
                  <?php echo form_upload(array('name' => 'userfile', 'id' => 'image'));	?>



                       <label>Type*</label>
                       
						<?php
							 $options=array('gallery'=>'Photo Gallery','pdf'=>'PDF','audio'=>'Audio','xls'=>'Excel File','doc'=>'Word file','file'=>'file','video'=>'Video','zip'=>'ZIP File'  );
								// $Industries  is for selected value
								echo form_dropdown('type', $options , 'image' );
						?>
					   
					   
                  <?php /*?><label>Media Group Description</label>
						<?php echo form_textarea(array('name' => 'group_desc', 'id' => 'group_desc', 'placeholder' => 'Media Group Description', 'value' => set_value('group_desc'))); ?><br /><?php */?>

<?php /*?><label>Media Group Description English</label>
						<?php echo form_textarea(array('name' => 'group_desc_en', 'id' => 'group_desc_en', 'placeholder' => 'Media Group Description', 'value' => set_value('group_desc_en'))); ?><?php */?>
					
                 
						
                        <label>Arrange</label>
						<?php echo form_input(array('name' => 'arrange', 'id' => 'arrange', 'placeholder' => 'Arrange', 'value' => set_value('arrange'))); 	?>
                         
                        

       
                  <label><br />
                        Related Tag</label>
						<?php echo form_input(array('name' => 'related_tag', 'id' => 'related_tag', 'placeholder' => 'Related Tag', 'value' => set_value('related_tag'))); ?>

 						<?php echo form_checkbox('active', '1', True);?>
						 <label>Active </label>
                         
						<?php
						
						echo form_submit(array('name' => 'add_project','id' => 'add_project', 'value' => 'Add Media Group', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
				
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
