<?php $this->load->view("admincms/includes/top.php"); ?>

			<div class="row" id='admin_section'>
				
    <div id="content_container" class="row">
		
		<div class="columns large-12">
			
			<ul class="no-bullet inline-list" id="manage_nav">
				<li><a href="<?php echo base_url(); ?>admincms/menus/add_main_menu/"><img src="<?php echo base_url(); ?>admin_view/images/icons/add.png"><span>Add Main Menu</span></a></li>
			</ul>	
			
			<?php echo $this->session->flashdata('user_updated'); ?>
			
			<?php 
			
		         $attributes = array('class' => 'email', 'id' => 'frm1'); 

				echo form_open('/admincms/menus/update_sub_menu_order',$attributes); ?>
			<table id="example" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                    <th><input type="checkbox" name="checkall" onclick="checkedAll();"></th>
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
					    <td><input type="checkbox" name="contentid[<?= $row->mst_menuid;?>]" value="<?= $row->mst_menuid;?>"></td>
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
						
                 

						<td><input type='text' name='arrange[<? echo $row->mst_menuid ?>] ' size='3' dir="ltr" value="<?php echo $row->order ?>" style="border-style: double; border-width: 3">  </td> 
                           <td><a href="<?= base_url('admincms/menus/edit_sub_menu/'.encodeId($row->mst_menuid));?>"> Edit </a></td>
					    <td><a href="<?= base_url('admincms/menus/delete_sub_menu/'.encodeId($row->mst_menuid));?>"> Delete </a></td>
                     
                        <input name="mst_menuid" type="hidden" value="<?= $row->mst_menuid ?>" />
					</tr>
										
					</tr>
                    
                    <?php endforeach; 
					
							}
							?>
					                   
                  </tbody>
                                   </table>
                    
				<br/>
				<?php
						
						echo form_submit(array('name' => 'sbm','id' => 'sbm', 'value' => 'Update Menu Order', 'class' => 'button radius right small'));
						echo form_submit(array('name' => 'sbm','id' => 'sbm', 'value' => 'Delete Selected Menus', 'class' => 'button radius right small','onclick'=>"return con('Are you sure you want to delete the selected menus?')"));

						echo form_close();
						
						?>
		</div>
	
	</div>

<script>		
$(document).ready(function() {
	$('#example').dataTable();
} ); //end ready functions

checked=false;
function checkedAll (frm1) {var aa= document.getElementById('frm1'); if (checked == false)
{
checked = true
}
else
{
checked = false
}for (var i =0; i < aa.elements.length; i++){ aa.elements[i].checked = checked;}
} // end checkedAll functions

function con(message) {
 var answer = confirm(message);
 if (answer) {
  return true;
 }

 return false;
} //end con functions
</script>
    
    
<?php $this->load->view("admincms/includes/footer.php"); ?>
