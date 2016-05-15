<?php $this->load->view("admincms/includes/top.php"); ?>

			<div class="row" id='admin_section'>
				
    <div id="content_container" class="row">
		
		<div class="columns large-12">
			
			<ul class="no-bullet inline-list" id="manage_nav">
				<li><a href="<?php echo base_url(); ?>admincms/pages/add_page_category/"><img src="<?php echo base_url(); ?>admin_view/images/icons/add.png"><span>Add Category</span></a></li>
			</ul>	
			
			<?php echo $this->session->flashdata('user_updated'); ?>
			
          <?php 
		  
		  $attributes = array('class' => 'email', 'id' => 'frm1');
		  echo form_open('/admincms/pages/update_category_arrange',$attributes); 
		  
		  
		  ?>

		<table id="example" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                    <th><input type="checkbox" name="checkall" onclick="checkedAll();"></th>
                    <th></th>
                	<th>Category Title</th>
                    <th>Arrange</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  	
							<?php 
							if(!empty($category))
							{
							foreach($category as $row) : ?>
		           <tr>
                   <td><input type="checkbox" name="contentid[<?php echo $row->category_id;?>]" value="<?php echo $row->category_id;?>"></td>
						<td><img src="<?php echo base_url(); ?>/private/pages/<?php echo $row->category_cover_thumb; ?>" width="140" height="100"></td>
                        <td><?php echo $row->category_name; ?></td>
						<td><input type='text' name='arrange[<?php echo $row->category_id ?>] ' size='3' dir="ltr" value="<?php echo $row->arrange ?>" style="border-style: double; border-width: 3">                       
                       
                        <td><a href="<?php echo base_url('admincms/pages/edit_category/'.$row->category_id.'/'.$row->sub_cat);?>"> Edit </a></td>
					    <td><a href="<?php echo base_url('admincms/pages/delete_category/'.$row->category_id);?>"> Delete </a></td>
                        
                       <input name="category_id" type="hidden" value="<?php echo $row->category_id ?>" />

					</tr>
										
					</tr>
                    
                    <?php endforeach; 
					
							}
							?>
					                   
                  </tbody>
                                   </table>
                                   <br />
		
        <?php
						
						echo form_submit(array('name' => 'sbm','id' => 'sbm', 'value' => 'Update Arrange', 'class' => 'button radius right small'));
						
						echo form_submit(array('name' => 'sbm','id' => 'sbm', 'value' => 'Delete Selected Categories', 'class' => 'button radius right small','onclick'=>"return con('Are you sure you want to delete the selected categories?')"));

						echo form_close();
						
						?>
		</div>
	
	</div>

<script src="<?php echo base_url(); ?>admin_view/js/jquery.dataTables.min.js"></script>
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
