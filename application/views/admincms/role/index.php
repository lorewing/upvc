<?php $this->load->view("admincms/includes/top.php"); ?>

			<div class="row" id='admin_section'>
				
    <div id="content_container" class="row">
		
		<div class="columns large-12">
			
			
			
			<?php echo $this->session->flashdata('user_updated'); ?>
			

		<table id="example" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>User</th>
                      <th>Role</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
               
                    $roles=array('administrator'=>'Administrator','power_user'=>'Power User','director'=>'Director','staff'=>'Staff','visitors'=>'Visitors');
                    foreach($roles as $key=>$value){ ?>
                    <tr>
                      <td class="center"><?php echo $value ?></td>
                      
                      <td class="center">
                      <a class="btn btn-info" href="<?php echo base_url() ?>admincms/roles/permission/<?php echo encodeId($key) ?>"> <i class="icon-edit icon-white"></i> Set Permission </a> 
                      </td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>                           <br />
		
       
		</div>
	
	</div>

<script src="<?= base_url(); ?>admin_view/js/jquery.dataTables.min.js"></script>
<script>		
$(document).ready(function() {
	$('#example').dataTable();
} );

</script>
 
    
    
<?php $this->load->view("admincms/includes/footer.php"); ?>
