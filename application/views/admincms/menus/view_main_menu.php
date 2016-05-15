<?php $this->load->view("admincms/includes/top.php"); ?>

			<div class="row" id='admin_section'>
				
    <div id="content_container" class="row">
		
		<div class="columns large-12">
			
			<ul class="no-bullet inline-list" id="manage_nav">
				<li><a href="<?php echo base_url(); ?>admincms/menus/add_main_menu/"><img src="<?php echo base_url(); ?>admin_view/images/icons/add.png"><span>Add Main Menu</span></a></li>
			</ul>	
			
			<?php echo $this->session->flashdata('user_updated'); ?>
			
			<?php echo form_open('/admincms/menus/update_main_menu_order'); ?>
			<table id="example" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                    <th>Menu Name</th>
                	<th>URL</th>
                    <th> Active</th> 
                    <th>order</th>
                    <th>Order Arrange</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  	
							<?php 
							if(!empty($mani_menu))
							{
							foreach($mani_menu as $row) : ?>
		           <tr>
						
                        <td><?php echo $row->title; ?></td>
                         <td><?php echo $row->url; ?></td>
                         <td><?php 
						 if($row->is_active==1)
						 {
							 echo "Yes";
							}else{
									echo "No" ;
								}?></td>
                         <td><?php echo $row->order; ?></td>
						
                 

						<td><input type='text' name='arrange[<?php echo $row->mst_menuid ?>] ' size='3' dir="ltr" value="<?php echo $row->order ?>" style="border-style: double; border-width: 3">  </td> 
                        <td><a href="<?= base_url('admincms/menus/edit_main_menu/'.encodeId($row->mst_menuid));?>"> Edit </a></td>
					    <td><a href="<?= base_url('admincms/menus/delete_main_menu/'.encodeId($row->mst_menuid));?>"> Delete </a></td>
                        
                        <input name="mst_menuid" type="hidden" value="<?php echo $row->mst_menuid ?>" />
					</tr>
										
					</tr>
                    
                    <?php endforeach; 
					
							}
							?>
					                   
                  </tbody>
                                   </table>
                    
				<br/>
				<?php
						
						echo form_submit(array('name' => 'arrange_cat','id' => 'arrange_cat', 'value' => 'Update Menu Order', 'class' => 'button radius right small'));
						
						echo form_close();
						
						?>
		</div>
	
	</div>

<script src="<?= base_url(); ?>admin_view/js/jquery.dataTables.min.js"></script>
<script>		
$(document).ready(function() {
	$('#example').dataTable();
} );

</script>
 
    
    
<?php $this->load->view("admincms/includes/footer.php"); ?>
