<?php $this->load->view("admincms/includes/top.php"); ?>

	<div id="content_container" class="row">
		
		<div class="columns large-12">
		
			<p>Welcome to the <?= $this->config->item('site_title'); ?> Content Management System.</p>
			
		
		</div>
        
        	<div id="content_container" class="row">
		
		
		
		<div id="main_content_section" class="columns large-12 left">
		
			<div id="form_add">
		
				<fieldset>
				
					<legend>Add Multiple Image</legend>
					
				
                   		<?php  
						
						$attributes = array('name' => 'add_content','id'=>'add_content','class'=>'');
	  					echo form_open_multipart('/admincms/multiple_upload/add_multiple_image',$attributes);


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
						<?php /*?><label>Image Name</label>
						<?php echo form_input(array('name' => 'title', 'id' => 'title', 'placeholder' => 'Media Title', 'value' => set_value('title'))); ?>
						<?php */?>
                        
                       <?php /*?> <label>Media Title English</label>
						<?php echo form_input(array('name' => 'title_en', 'id' => 'title_en', 'placeholder' => 'Media Title English', 'value' => set_value('title_en'))); ?>
						<?php */?>
                        
                            <div class="clearfix"></div>
                              <div class="input-control">
                                <label class="control-label" for="typeahead">Image: </label>
                                <div class="input-group input-switch-group"><input type="file" name="userfile[]"  class="" id="userfile" multiple />
                                <?php /*?><button type="button" id="upload" name="upload" class="btn btn-large" style="float: right;">Upload</button><?php */?>
                                <br>
                                <em>Select multiple images use Ctrl + Select Images</em></div> </div>
     					 <div class="clearfix"></div>
						<br/>
						
						<?php
						
						echo form_submit(array('name' => 'add_project','id' => 'add_project', 'value' => 'Add Images', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
				
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
