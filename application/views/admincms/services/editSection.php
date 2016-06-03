<?php $this->load->view("admincms/includes2016/top.php"); ?>


<div class="row">
                  
            <div class="col-md-12">
                
			<div class="portlet-body">
		<h3 class="page-title"><?php echo lang('Edit Post'); ?> </h3>
                <?php 
								
								if(!empty($update_record)){
							echo $update_record;
							}
					?> 
                 <hr>
					
					 <?php foreach($rows as $r) : ?>
                    	  <?php 
								$section_id = $r->section_id;
								$section_name_ar = $r->section_name_ar;
                                                                $section_name_en = $r->section_name_en;
								$section_cover = $r->section_cover;
								$section_cover_thumb = $r->section_cover_thumb;
								$section_desc_ar = $r->section_desc_ar;
                                                                $section_desc_en = $r->section_desc_en;
								$class_name = $r->class_name;
								$active = $r->active;
								$url = $r->url;
								
								
							?>
                    	  
                    	  <?php endforeach; ?>
                   		<?php echo form_open_multipart('/admincms/services/update_section'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
                            
                           <div class="form-group"> 
                             <label><?php echo lang('Title_ar') ; ?></label>
			     <?php echo form_input(array('name' => 'section_name_ar', 'id' => 'section_name_ar', 'class' => 'form-control spinner','placeholder' => lang('Title_ar'), 'value' => $section_name_ar)); ?>
                             </div>
                 
                          <div class="form-group"> 
                             <label><?php echo lang('Title_en') ; ?></label>
			     <?php echo form_input(array('name' => 'section_name_en', 'id' => 'section_name_en', 'class' => 'form-control spinner','placeholder' => lang('Title_en'), 'value' => $section_name_en)); ?>
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
                                <img src="<?php echo base_url(); ?>private/post/<?= $section_cover_thumb; ?>" width="250" height="250"></p>
                              <p>
                                <?php echo form_upload(array('name' => 'userfile', 'id' => 'image'));	?>
                            </div>
                            
                            <div class="form-group"> 
                                <label><?php echo lang('Desc_ar') ; ?></label>
				<?php echo form_textarea(array('name' => 'section_desc_ar', 'id' => 'section_desc_ar', 'placeholder' => lang('Desc_ar'), 'value' => $section_desc_ar )); ?>
					
                            </div>
                            
                            <div class="form-group"> 
                                <label><?php echo lang('Desc_en') ; ?></label>
				<?php echo form_textarea(array('name' => 'section_desc_en', 'id' => 'section_desc_en', 'placeholder' => lang('Desc_en'), 'value' => $section_desc_en )); ?>
					
                            </div>
                     
                    <div class="form-group"> 
                         <label><?php echo lang('Class Name') ; ?></label>
			<?php echo form_input(array('name' => 'class_name', 'id' => 'class_name','class' => 'form-control spinner', 'placeholder' => lang('Class Name'), 'value' => $class_name)); ?>
                     </div>
                            
                            <div class="form-group"> 
                         <label><?php echo lang('URL') ; ?></label>
						<?php echo form_input(array('name' => 'url', 'id' => 'url','class' => 'form-control spinner', 'placeholder' => lang('URL'), 'value' => $url)); ?>
                     </div>
                 
                 
                 
                 
                             <div class="form-actions">
                              
                                  <label class="rememberme mt-checkbox mt-checkbox-outline">
                              <?php echo form_checkbox('active', '1', $active);?><?php echo lang('Show On First Page') ; ?>
                                <span></span>
                            </label>
                                 
				       <input name="section_id" type="hidden" value="<?php echo $section_id?>" />
                             </div>        
                                            
				<div class="form-actions">		
                                    <?php echo form_submit(array('name' => 'edit_post','id' => 'edit_post', 'value' => 'Edit Services Section', 'class' => 'btn green uppercase'));

                                    echo form_close();

                                    ?>
                        
                                </div>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes2016/footer.php"); ?>
