<?php $this->load->view("admincms/includes/top.php"); ?>

	<div id="content_container" class="row">
		
		<div class="columns large-12">
		
			<p>Welcome to the <?= $this->config->item('site_title'); ?> Content Management System.</p>
			
			 
		</div>
        
        	<div id="content_container" class="row">
		
		
		
		<div id="main_content_section" class="columns large-12 left">
			<?php 
								
								if(!empty($update_record)){
							echo $update_record;
							}
					?> 
			<div id="form_add">
		
				<fieldset>
				
					<legend>Edit Main Menu - </legend>
						
					
						
                    
                    	<p>
                    	  <?php foreach($rows as $r) : ?>
                    	  <?php 
								$mst_menuid = $r->mst_menuid; 
								$menu_parent_id = $r->menu_parent_id;
								$title = $r->title;
								$url = $r->url;
								$target = $r->target;
								$order = $r->order;
								$is_active = $r->is_active;
								$class_name = $r->class_name;
							?> 
                    	  
                    	  <?php endforeach; ?>
                    	  
                    	  
                    	  <?php echo form_open('/admincms/menus/update_sub_menu/'); 


                        echo validation_errors('<p class=\'error\'>');
						
						echo $this->session->flashdata('message');
						if(!empty($error)){
							echo $error;
							}
						?>
                        
                                            	  <label>Menu Name*</label>
						<?php echo form_input(array('name' => 'title', 'id' => 'title', 'placeholder' => 'Title', 'value' => $title)); ?>
						
                        <label>Main Menu*</label>
                       		<select name="menu_parent_id">
                            <option value=""> Please Select Main Menu</option>
                            <?
                        	$query = $this->db->get_where('mst_menus', array('menu_parent_id '=>'0','is_active'=>'1'));
							
									foreach ($query->result() as $row)
									{?>
										 <option value="<?= $row->mst_menuid;?>" <?php if ($row->mst_menuid === $menu_parent_id) echo 'selected="selected"'?>><?= $row->title;?></option>				
									<?} // end for each
							?>
							</select>
                        
                        <label>URL*</label>
						<?php echo form_input(array('name' => 'url', 'id' => 'url', 'placeholder' => 'URL', 'value' => $url)); ?>
						
                        <label>Target</label>
                       
						<?php
							 $options=array('_blank'=>'Blank','new'=>'New Windows','_self'=>'Same Page');
								// $Industries  is for selected value
								echo form_dropdown('target', $options , $target );
						?>
                        
                        
                        <label>Order</label>
						<?php echo form_input(array('name' => 'order', 'id' => 'order', 'placeholder' => 'order', 'value' => $order)); ?>
						
                        <label>class_name</label>
						<?php echo form_input(array('name' => 'class_name', 'id' => 'class_name', 'placeholder' => 'Class Name', 'value' => $class_name)); ?>
						
 						
                        <label>Active</label> 
                        <?php echo form_checkbox('is_active', '1',$is_active); ?>
						
                       <input name="mst_menuid" type="hidden" value="<?= $mst_menuid; ?>" />
						<?php echo form_submit(array('name' => 'edit_portfolio','id' => 'edit_portfolio', 'value' => 'Edit Portfolio', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
				
				</fieldset>
			
			</div>
		
		</div>
	
	</div>
	
	</div>

<?php $this->load->view("admincms/includes/footer.php"); ?>
