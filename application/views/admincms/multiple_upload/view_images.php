<?php $this->load->view("admincms/includes/top.php"); ?>

			<div class="row" id='admin_section'>
				
    <div id="content_container" class="row">
		
		<div class="columns large-12">
			
			<ul class="no-bullet inline-list" id="manage_nav">
				<li><a href="<?php echo base_url(); ?>admincms/multiple_upload/add_multiple_image/"><img src="<?php echo base_url(); ?>admin_view/images/icons/add.png"><span>Add Add Multiple Image</span></a></li>
			</ul>	
			
			<?php echo $this->session->flashdata('user_updated'); ?>
			
          <?php 
		  
		  $attributes = array('class' => 'email', 'id' => 'frm1');
		  echo form_open('admincms/multiple_upload/delete_selected_images',$attributes); ?>

		<table id="example" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                    <th><input type="checkbox" name="checkall" onclick="checkedAll();"></th>
                    
                	<th>Image Picture</th>
                    <th>Image Name</th>
                    <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  	
							<?php 
							if(!empty($rows))
							{
							foreach($rows as $row) : ?>
		           <tr>
                   <td><input type="checkbox" name="imageid[<?= $row->image_id;?>]" value="<?= $row->image_id;?>"></td>
                     
                      <?php  
					 	$src2='http://bti-interactive.com/test/multi_upload/private/media/09bf4e9163e8fcc573df5a1693708e25.jpg';
					  $src= base_url() .'private/images/'. $row->image_name;
					  $Image_source = getImageResizePath($src,200,140);
					  
					   ?>
                   <td><img src="<?php echo $Image_source ?>"></td>
                   <td><?php echo $src; ?></td>
                   
                   <?php /*?> <td><?= $row->image_name;?></td><?php */?>
                        	
                        
                        
<?php /*?>						<td><?php echo form_input(array('Industries_arrange' => 'Industries_arrange', 'style'=> 'width:27%', 'id' => 'Industries_arrange', 'placeholder' => 'Industries Arrange', 'value'=> $row->Industries_arrange)); ?></td>
<?php */?>					

						
						
					    <td><a href="<?= base_url('admincms/multiple_upload/delete_images/'.encodeId($row->image_id));?>"> Delete </a></td>
                        
                       <input name="image_id" type="hidden" value="<?= $row->image_id ?>" />

					</tr>
										
					</tr>
                    
                    <?php endforeach; 
					
							}
							?>
					                   
                  </tbody>
                                   </table>
                                   <br />
		
        <?php
						
						echo form_submit(array('name' => 'sbm','id' => 'sbm', 'value' => 'Delete Selected Images', 'class' => 'button radius right small','onclick'=>"return con('Are you sure you want to delete the selected Images?')"));

						echo form_close();
						
						?>
		</div>
	
	</div>

<script src="<?= base_url(); ?>admin_view/js/jquery.dataTables.min.js"></script>
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
