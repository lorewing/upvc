<?php $this->load->view("admincms/includes/top.php"); ?>



	<div id="content_container" class="row">

		

		<div class="columns large-12">

		

			<p>Welcome to the <?php echo  $this->config->item('site_title'); ?> Content Management System.</p>

			

		

		</div>

        

        	<div id="content_container" class="row">

		

		

		

		<div id="main_content_section" class="columns large-12 left">

		

			<div id="form_add">

		

				<fieldset>

				

					<legend>Edit Media</legend>

					

                      <?php foreach($rows as $r) : ?>

                    	  <?php 

								$media_id = $r->media_id;

								$group_id = $r->group_id;

								$title = $r->title;

								$desc = $r->desc;

								$video_url = $r->video_url;

								$active = $r->active;

								$type = $r->type;

								

								$related_tag = $r->related_tag;

								$media_name = $r->media_name;

								$media_thumb = $r->media_thumb;

								

								

							?>

                    	  

                    	  <?php endforeach; ?>

				

                   		<?php  

						

						$attributes = array('name' => 'add_content','id'=>'add_content','class'=>'');

	  					echo form_open_multipart('/admincms/media/update_media',$attributes);





                        echo validation_errors('<p class=\'error\'>');

						

						echo $this->session->flashdata('message');

						if(!empty($error)){

							echo $error;

							}

						?>

						<label>Media Title</label>

						<?php echo form_input(array('name' => 'title', 'id' => 'title', 'placeholder' => 'Media Title', 'value' => $title)); ?>

						

                         <input name="media_id" type="hidden" value="<?php echo $media_id?>" />

                        

                        <label>Upload Image</label>
                        
                        <img src="<?php echo base_url(); ?>private/media/<?php echo $media_name; ?>" width="250" height="250"></p>


                        <div class="input-group input-switch-group"><input type="file" name="userfile"  class="" id="userfile" multiple />



						<label>Media Group*</label>

                       		<select name="group_id">

                            <option value=""> Please Select Your Media Group</option>

                            <?php $query = $this->db->get('media_group');

							

							

									foreach ($query->result() as $row)

									{?>

										 <option value="<?php echo  $row->group_id;?>" <?php if ($row->group_id === $group_id) echo 'selected="selected"'?>><?php echo  $row->group_name;?></option>				

									<?php } // end for each

							?>

							</select>

					   

                  <br />



                       <label>Type*</label>

                       

						<?php

							 $options=array('image'=>'Image','pdf'=>'PDF','audio'=>'Audio','xls'=>'Excel File','doc'=>'Word file','file'=>'file','video'=>'Video','zip'=>'ZIP File','gallery'=>'Photo Gallery'  );

								// $Industries  is for selected value

								echo form_dropdown('type', $options , $type );

						?>

					   

                        

					   

                  <label>Media Description</label>

						<?php echo form_textarea(array('name' => 'desc', 'id' => 'desc', 'placeholder' => 'Media Description', 'value' => $desc)); ?>

						<br />

                        

                        

                        <label><br />

                        Related Tag</label>

						<?php echo form_input(array('name' => 'related_tag', 'id' => 'related_tag', 'placeholder' => 'Related Tag', 'value' => $related_tag)); ?>

						

                         <label>Video URL</label>

                        <?php echo form_input(array('name' => 'video_url', 'id' => 'video_url', 'placeholder' => 'Video URL', 'value' => $video_url)); ?>



						<br />

                        

                        				      



						<?php

						

						echo form_submit(array('name' => 'add_project','id' => 'add_project', 'value' => 'Update Media', 'class' => 'button radius right small'));

						

						echo form_close();

						

						?>

				

				</fieldset>

			

			</div>

		

		</div>

	

	</div>

	

	</div>



<?php $this->load->view("admincms/includes/footer.php"); ?>

