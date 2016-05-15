<?php $this->load->view("admincms/includes/top.php"); ?>

	<div id="content_container" class="row">
		
		<div class="columns large-12">
		
			<p>Welcome to the <?= $this->config->item('site_title'); ?> Content Management System.</p>
			
		
		</div>
        
        	<div id="content_container" class="row">
		
		
		
		<div id="main_content_category" class="columns large-12 left">
		
			<div id="form_add">
		<?php 
			foreach ($rows as $r)
			{
					$player_id = $r->player_id;
					$name_ar = $r->name_ar;
					$image_name = $r->image_name;
					$club_ar = $r->club_ar;
					$weight = $r->weight;
					$height = $r->height;
					$postion = $r->postion;
					$international_matches = $r->international_matches;
					$nationality = $r->nationality;
					$arrange = $r->arrange;
					$description_ar = $r->description_ar;
					$active = $r->active;
					$show_first_page = $r->show_first_page;
					
			}
		
		?>
				<fieldset>
				
					<legend>Edit Player Profile</legend>
					
				
                   		<?php echo form_open_multipart('/admincms/profile/update_profile'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
				  <label>Player Name*</label>
						<?php echo form_input(array('name' => 'name_ar', 'id' => 'name_ar', 'placeholder' => 'Player Name', 'value' => $name_ar)); ?>
						
                  <?php /*?><label>Category Title English</label>
						<?php echo form_input(array('name' => 'category_name_en', 'id' => 'category_name_en', 'placeholder' => 'Category Title English', 'value' => set_value('category_name_en'))); ?><?php */?>
						
                        <label>Player Image</label>
                        <img src="<?php echo base_url() ; ?>/private/profile/<?php echo $image_name ; ?>" width="170" height="250" /> <br /> <br />
                  <?php echo form_upload(array('name' => 'userfile', 'id' => 'image'));	?>

			    
                        
                        <br />
                        <label>Club name </label>
                        <?php echo form_input(array('name'=>'club_ar','id'=>'club_ar','placeholder'=>'Club Name','value'=> $club_ar)); ?>
                        
                       
                        <label>Weight</label>
                        <?php echo form_input(array('name'=>'weight','id'=>'weight','placeholder'=>'Player Weight','value'=> $weight)); ?>
                        
                       
                        <label>Height </label>
                        <?php echo form_input(array('name'=>'height','id'=>'height','placeholder'=>'Player Height','value'=> $height)); ?>
                        
                       
                  <label>Postion</label>
						<?php echo form_input(array('name' => 'postion', 'id' => 'postion', 'placeholder' => 'Meta Keywords', 'value' => $postion)); ?>
                        
                       
                  <label>International Matches</label>
						<?php echo form_input(array('name' => 'international_matches', 'id' => 'international_matches', 'placeholder' => 'International Matches', 'value' => $international_matches)); ?>
                        
                        
                  <label>Nationality</label>
						<?php echo form_input(array('name' => 'nationality', 'id' => 'nationality', 'placeholder' => 'Meta Keywords', 'value' => $nationality)); ?>
                        
                        <label>Arrange</label>
						<?php echo form_input(array('name' => 'arrange', 'id' => 'arrange', 'placeholder' => 'Arrange', 'value' => $arrange)); 	?>
					    
                  <label>Player Description </label>
						<?php echo form_textarea(array('name' => 'description_ar', 'id' => 'description_ar', 'placeholder' => 'Player Description', 'value' => $description_ar)); ?>
                  
                  
                       <br />
                       <?php echo form_checkbox('show_first_page','1',$show_first_page) ?>
                          <label>Show On First Page </label>
				
                	<?php echo form_checkbox('active','1',$active)?> 
                         <label>Active </label>
                     
              <?php /*?>    <br />
                  <label>Category Description Arabic</label>
						<?php echo form_textarea(array('name' => 'category_desc_ar', 'id' => 'category_desc_ar', 'placeholder' => 'Category Description', 'value' => set_value('category_desc_ar'))); ?>
						
                  <label><br />
                  Category Description English</label>
						<?php echo form_textarea(array('name' => 'category_desc_en', 'id' => 'category_desc_en', 'placeholder' => 'Category Description', 'value' => set_value('category_desc_en'))); ?><?php */?>
					
                      <br />
                      
                     <input name="player_id" type="hidden" value="<?php echo $player_id?>" />

						
						<?php
						
						echo form_submit(array('name' => 'add_prfile','id' => 'add_prfile', 'value' => 'Edit Player Profile', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
				
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
