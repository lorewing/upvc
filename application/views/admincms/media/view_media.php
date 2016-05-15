<?php $this->load->view("admincms/includes/top.php"); ?>

			<div class="row" id='admin_section'>
				
    <div id="content_container" class="row">
		
		<div class="columns large-12">
			
			<ul class="no-bullet inline-list" id="manage_nav">
				<li><a href="<?php echo base_url(); ?>admincms/media/add_media/"><img src="<?php echo base_url(); ?>admin_view/images/icons/add.png"><span>Add Media</span></a></li>
			</ul>	
			
			<?php echo $this->session->flashdata('user_updated'); ?>
			
          <?php 
		  
		  $attributes = array('class' => 'email', 'id' => 'frm1');
		  echo form_open('/admincms/media/delete_selected_media',$attributes); ?>

		<table id="example" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                    <th><input type="checkbox" name="checkall" onclick="checkedAll();"></th>
                    <th></th>
                	<th>Media Title</th>
                    <th>Category Name</th>
                    <th>Media Type</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  	
							<?php 
							if(!empty($media))
							{
							foreach($media as $row) : ?>
		           <tr>
                   <td><input type="checkbox" name="media_count[<?= $row->media_id;?>]" value="<?= $row->media_id;?>"></td>
						<td><img src="<?php echo base_url(); ?>private/media/<?= $row->media_thumb; ?>" width="56" height="57"></td>
                        <td><?php echo $row->title; ?></td>
                        <td><?php echo $row->group_name; ?></td>	
                        <td><?php echo $row->type; ?></td>
                        <td><a href="<?= base_url('admincms/media/edit_media/'.encodeId($row->media_id));?>"> Edit </a></td>
					    <td><a href="<?= base_url('admincms/media/delete_media/'.encodeId($row->media_id));?>"> Delete </a></td>
                        
                       <input name="media_id" type="hidden" value="<?= $row->media_id ?>" />

					</tr>
										
					</tr>
                    
                    <?php endforeach; 
					
							}
							?>
					                   
                  </tbody>
                                   </table>
                                   <br />
		
        <?php
						
						echo form_submit(array('name' => 'sbm','id' => 'sbm', 'value' => 'Delete Selected Media', 'class' => 'button radius right small','onclick'=>"return con('Are you sure you want to delete the selected media?')"));

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
