<?php $this->load->view("admincms/includes2016/top.php"); ?>
 <h3 class="page-title"><?php echo lang('View Edit Services') ; ?> </h3>
  <hr>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                  
                    
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-globe"></i><?php echo lang('View Edit Services') ; ?></div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    
                                    <?php echo $this->session->flashdata('user_updated'); ?>
			
          <?php 
		  
		  $attributes = array('class' => 'email', 'id' => 'frm1');
		  echo form_open('/admincms/services/update_section_arrange',$attributes); ?>
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_3" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="all"><input type="checkbox" name="checkall" onclick="checkedAll();"></th>
                                                <th class="all"><?php echo lang('Picture'); ?></th>
                                                <th class="all"><?php echo lang('services names'); ?></th>
                                                 <th class="all"><?php echo lang('Order Arrange');?></th>
                                                <th class="all"><?php echo lang('Edit'); ?></th>
                                                <th class="all"><?php echo lang('Delete'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
							if(!empty($post))
							{
							foreach($post as $row) : ?>
		           <tr>
                   <td><input type="checkbox" name="contentid[<?php echo $row->section_id;?>]" value="<?php echo $row->section_id;?>"></td>
                        <td class="hidden-sm hidden-xs"><img src="<?php echo base_url(); ?>/private/post/<?= $row->section_cover_thumb; ?>" class="responsive" width="140" height="100"></td>
                        <td><?php echo $row->section_name_en; ?></td>
                         
                        
                        <td><input type='text' name='arrange[<?php echo $row->section_id ?>] ' size='3' dir="ltr" value="<?php echo $row->view_order ?>" style="border-style: double; border-width: 3">  </td> 

                       
                        <td><a href="<?php echo base_url('admincms/services/edit_section/'.$row->section_id);?>"> Edit </a></td>
					    <td><a href="<?php echo base_url('admincms/services/delete_services/'.$row->section_id);?>"> Delete </a></td>
                        
                       <input name="section_id" type="hidden" value="<?php echo $row->section_id ?>" />

					</tr>
			
                    <?php endforeach; 
					
							}
							?>
					                   
                  </tbody>
                                   </table>
                                   <br />
		<div class="form-actions">
                <?php
						
/*						echo form_submit(array('name' => 'sbm','id' => 'sbm', 'value' => 'Update Arrange', 'class' => 'button radius right small'));
*/						
						echo form_submit(array('name' => 'sbm','id' => 'sbm', 'value' => lang('Delete Selected Sections'), 'class' => 'btn green uppercase','onclick'=>"return con('Are you sure you want to delete the selected Sections?')"));
                             			echo form_submit(array('name' => 'sbm','id' => 'sbm', 'value' => 'Update Arrange', 'class' => 'btn green uppercase'));

						echo form_close();
						?>

                                </div>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
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
    
<?php $this->load->view("admincms/includes2016/footer.php"); ?>
