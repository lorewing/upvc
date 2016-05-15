<?php $this->load->view("admincms/includes/top.php"); ?>

			<div class="row" id='admin_section'>
				
    <div id="content_container" class="row">
		
		<div class="columns large-12">
			
			<ul class="no-bullet inline-list" id="manage_nav">
				<li><a href="<?php echo base_url(); ?>admincms/users/add_users/"><img src="<?php echo base_url(); ?>admin_view/images/icons/add.png"><span>Add User</span></a></li>
			</ul>	
			
			<?php echo $this->session->flashdata('user_updated'); ?>
			
         

		<table id="example" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                    
                	<th>First Name</th>
                    <th>Last Name</th>
                    <th>User Name</th>
                   <th>User Email</th>
                    <th>Permissions</th>
                     <th>Active</th>
                  
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  	
							<?php 
							if(!empty($users))
							{
							foreach($users as $row) : ?>
		           <tr>
                        <td><?php echo $row->user_first_name; ?></td>
                        <td><?php echo $row->user_last_name; ?></td>	
                        <td><?php echo $row->username; ?></td>
                        <td><?php echo $row->user_email; ?></td>
                        <td><?php echo $row->role; ?></td>
                         <td><?php 
						 if ($row->active==1){
							 echo "Yes";
							 }else{
								 	echo "No";
								 } ?></td>
                        	
                        
                        <td><a href="<?= base_url('admincms/users/edit_users/'.encodeId($row->user_id));?>"> Edit </a></td>
                        <td><a href="<?= base_url('admincms/users/delete_users/'.encodeId($row->user_id));?>"> Delete </a></td>

                        
                       <input name="user_id" type="hidden" value="<?= $row->user_id ?>" />

					</tr>
										
					</tr>
                    
                    <?php endforeach; 
					
							}
							?>
					                   
                  </tbody>
                                   </table>
                                   <br />
		
       
		</div>
	
	</div>

<script src="<?= base_url(); ?>admin_view/js/jquery.dataTables.min.js"></script>
<script>		
$(document).ready(function() {
	$('#example').dataTable();
} );

</script>
 
    
    
<?php $this->load->view("admincms/includes/footer.php"); ?>
