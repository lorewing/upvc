<?php $this->load->view("admincms/includes2016/top.php"); ?>

	<div class="row">
                  
            <div class="col-md-12">
                
			<div class="portlet-body">
		<h3 class="page-title"> <?php echo lang('Add a Services Section') ; ?> </h3>
                 <hr>
                        </div>
		
		<div id="main_content_section" class="columns large-12 left">
		
			<div id="form_add">
				
                   		<?php echo form_open_multipart('/admincms/services/add_services_section'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
                                       
                             <div class="form-group"> 
                  <label><?php echo lang('Title_en') ; ?></label>
						<?php echo form_input(array('name' => 'section_name_en', 'id' => 'section_name_en', 'class' => 'form-control spinner','placeholder' => lang('Title_en'), 'value' => set_value('section_name_en'))); ?>
                             </div>
                            
                           <div class="form-group">
				<label><?php echo lang('Section'); ?></label>
                       		<select name="section_parent_id" class="form-control input-large">
                            <option value=""><?php echo lang('Please Select your Section'); ?></option>
                            <?php
                                $query = $this->db->get_where('post_section', array('section_type' => 'services'));

							

                                    foreach ($query->result() as $row)

                                    {?>
                                             <option value="<?php echo $row->section_id;?>"><?php echo $row->section_name_en;?></option>				
                                    <?php } // end for each
				?>
							</select>
                            </div>
                            
                             <div class="form-group"> 
                        <label><?php echo lang('Section_Cover_Image') ; ?></label>
                  <?php echo form_upload(array('name' => 'userfile', 'id' => 'image'));	?>

                             </div>
		
                             <div class="form-group"> 
                  <label><?php echo lang('Desc_en') ; ?></label>
						<?php echo form_textarea(array('name' => 'section_desc_en', 'id' => 'section_desc_en', 'placeholder' => lang('Desc_en'), 'value' => set_value('section_desc_en'))); ?>
					
                             </div>
                     
                    <div class="form-group"> 
                         <label><?php echo lang('Class Name') ; ?></label>
						<?php echo form_input(array('name' => 'class_name', 'id' => 'class_name','class' => 'form-control spinner', 'placeholder' => lang('Class Name'), 'value' => set_value('class_name'))); ?>
                     
                         <p>Click <a href="http://fontawesome.io/icons/" target="_blank">here</a> to select icons design name</p>
                    </div>
                            
                            <div class="form-group"> 
                         <label><?php echo lang('URL') ; ?></label>
						<?php echo form_input(array('name' => 'url', 'id' => 'url','class' => 'form-control spinner', 'placeholder' => lang('URL'), 'value' => set_value('url'))); ?>
                     </div>
                            
                            <div class="form-actions">
                            <label class="rememberme mt-checkbox mt-checkbox-outline">
                                <input type="checkbox" id="active" name="active" value="1" checked="checked" class="md-check" <?php echo set_checkbox('active', '1'); ?>><?php echo lang('Show On First Page');?> 
                                <span></span>
                             </label>
                         </div>
                            
                            <div class="form-actions">
						<?php
						
						echo form_submit(array('name' => 'add_project','id' => 'add_project','class' => 'btn green uppercase', 'value' => lang('Add Section') ));
						
						echo form_close();
						
						?>
				
                            </div>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes2016/footer.php"); ?>
