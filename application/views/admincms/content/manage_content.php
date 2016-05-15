<?php $this->load->view("admincms/includes/top.php"); ?>



			<div class="row" id='admin_section'>

				

    <div id="content_container" class="row">

		

		<div class="columns large-12">

        

						<?php 

						$attributes = array('class' => 'email', 'id' => 'frm1');



						

						echo form_open('/admincms/content/delete_all_content', $attributes); ?>



			<ul class="no-bullet inline-list" id="manage_nav">

				<li><a href="<?php echo base_url(); ?>admincms/content/add_content/"><img src="<?php echo base_url(); ?>admin_view/images/icons/add.png"><span>Add Content</span></a></li>

<!--				<li><a href="<?php echo base_url(); ?>/admincms/content/delete_all_content/"><img src="<?php echo base_url(); ?>admin_view/images/icons/no.png"><span>Delete All Content</span></a></li>

-->            

			</ul>	

			

			<?php echo $this->session->flashdata('user_updated'); ?>

			<table id="example" class="display" cellspacing="0" width="100%">

                  <thead>

                    <tr>	

		    		<th>			<input type="checkbox" name="checkall" onclick="checkedAll();"></th>

		    		<th>ID</th>

		    		<th>Title</th>

		    		<th>Arabic Link</th>
                    <th>English Link</th>

		    		<th>Content</th>

		    		<th>Edit</th>

		    		<th>Delete</th>

		    	</tr>

                  </thead>

                  <tbody>

                  	

							<?php 

							if(!empty($manage_content))

							{

							foreach($manage_content as $row) : ?>

		           

						

                        <tr>

				    		<td><input type="checkbox" name="contentid[<?= $row->id;?>]" value="<?= $row->id;?>"></td>

				    		<td><?php echo $row->id; ?></td>

				    		<td><?php echo $row->title; ?></td>

				    		<td><a href="<?= base_url()?>home/pages/<?php echo $row->id; ?>" target="_blank">home/pages/<?php echo $row->id; ?> </a></td>
<td><a href="<?= base_url()?>home/pages_en/<?php echo $row->id; ?>" target="_blank">home/pages_en/<?php echo $row->id; ?> </a></td>
				    		<td><?php echo strip_tags(word_limiter($row->content, 5)); ?></td>

				    		<td><a href="<?= base_url('admincms/content/edit_content/'.encodeId($row->id));?>"> Edit </a></td>

                            <td><?php echo anchor('admincms/content/delete_content/' . encodeId($row->id), 'Delete', 

							array('onclick' => "return confirm('Are you sure you want to delete this content?')")); ?></td>

							

                        

							

				    	</tr> 

                        <input name="id" type="hidden" value="<?= $row->id ?>" />

					

										

					

                    

                    <?php endforeach; 

					

							}

							?>

					                   

                  </tbody>

                                   </table>



                                   <?php

						

						echo form_submit(array('name' => 'sbm','id' => 'sbm', 'value' => 'Delete Selected Contents', 'class' => 'button radius right small','onclick'=>"return con('Are you sure you want to delete the selected contents?')"));



						echo form_close();

						

						?>

                    

				<br/>

				

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

