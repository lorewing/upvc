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
								$ads_url = $r->ads_url;
								
							?>
                    	  
                    	  <?php endforeach; ?>
                   		<?php echo form_open_multipart('/admincms/ads/update_ads'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
				  
						
                       <label>Ads Title</label>
						<?php echo form_input(array('name' => 'group_name', 'id' => 'group_name', 'placeholder' => 'Ads Title', 'value' => $group_name)); ?>
						
                       <?php /*?> <label>Media Group Title English</label>
						<?php echo form_input(array('name' => 'group_name_en', 'id' => 'group_name_en', 'placeholder' => 'Media Group Title', 'value' => set_value('group_name_en'))); ?><?php */?>
						
                   <img src="<?php echo base_url(); ?>private/ads/<?= $album_cover; ?>" width="250" height="250"></p>
                    	<p>
                    	  <?php echo form_upload(array('name' => 'userfile', 'id' => 'image'));	?>
                   
                    <br />


                       <label>Type*</label>
                       
						<?php
							 $options=array('Sidebar-Top'=>'Sidebar Top','Sidebar-bottom'=>'Sidebar Bottom','Homepage-Middle'=>'Homepage Middle','Homepage-Bottom'=>'Homepage Bottom'  );
								// $Industries  is for selected value
								echo form_dropdown('type', $options , $group_type );
						?>
					   
					   
                  <?php /*?><label>Media Group Description</label>
						<?php echo form_textarea(array('name' => 'group_desc', 'id' => 'group_desc', 'placeholder' => 'Media Group Description', 'value' => set_value('group_desc'))); ?><br /><?php */?>

<?php /*?><label>Media Group Description English</label>
						<?php echo form_textarea(array('name' => 'group_desc_en', 'id' => 'group_desc_en', 'placeholder' => 'Media Group Description', 'value' => set_value('group_desc_en'))); ?><?php */?>
					
                 <label><br />
                        URL (should start with http://)</label>
						<?php echo form_input(array('name' => 'ads_url', 'id' => 'ads_url', 'placeholder' => 'http://www.google.com', 'value' => $ads_url)); ?>
						
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
