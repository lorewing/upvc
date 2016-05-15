<?php

	class Profile extends CI_Controller
	{
		function __construct()
		{
			
			parent:: __construct();
			$this->load->helper('cookie');
			$this->load->library('session');
			$this->load->model('membership_model');
			$this->is_logged_in();
			//$this->membership_model->getKeywords('Portfolio'); // load keywords for each profile based on controler name
			
		}
	
		public function index()
		{
				$data['site_title'] = "Add Media Group";
				$this->load->view('admincms/profile/add_profile', $data);
			 
		}
		
		
		function is_logged_in()
		{
			
			  $is_remember = get_cookie('remember_me');
				$identity = get_cookie('identity');
				if(isset($is_remember) && $is_remember==TRUE) {
				   $this->membership_model->getUserData($identity);
				   //$this->load->view('portal/home');
				}
			
			$is_logged_in = $this->session->userdata('is_logged_in');
			if(!isset($is_logged_in) || $is_logged_in != true)
			{
				redirect("admincms/login");
			}		
		} // end function is_logged_in
	
		
		function add_profile()
		{
			
			//Form Validation
			$this->form_validation->set_rules('name_ar', 'Player Name', 'trim|required|xss_clean');
			
			
		
			//If form validation failed, return to the form and throw out errors
			if($this->form_validation->run() == false)
			{
				//echo "errors";
				$data['site_title'] = "Add Player Profile";
				$this->load->view('admincms/profile/add_profile', $data);
			}
			else
			{
			
				if (empty($_FILES['userfile']['name'])) {
							$data = array(
							   'name_ar' 		=> $this->input->post('name_ar'),
							   'description_ar' => $this->input->post('description_ar'),
							   'arrange' 		=> $this->input->post('arrange'),
							   'club_ar' 		=> $this->input->post('club_ar'),
							   'weight' 		=> $this->input->post('weight'),
							   'height' 		=> $this->input->post('height'),
							   'international_matches' 		=> $this->input->post('international_matches'),
							   'postion' 					=> $this->input->post('postion'),
							   'nationality' 		=> $this->input->post('nationality'), 
							   'show_first_page' 		=> $this->input->post('show_first_page'), 
							   'active' 		=> $this->input->post('active'), 
							   'image_name' 		=> 'player_profile_default.jpg',
							   'image_thumb' 		=> 'player_profile_default.jpg',
							   'author' 		=> $this->session->userdata('current_user')
							);
								
							// get insert id  and save it in $content_id
							//$grouprofiles_id = $this->general->addData('media_group',$data);
							
							$result = $this->db->insert('player_profile', $data); 
		
						
						$this->session->set_flashdata('message', '<p class=\'success\'>Player Profile was successfully added.</p>');
						redirect(current_url());
					
				}else{
				$config['upload_path'] 			= './private/profile/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
				$config['max_size'] = '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				$config['encrypt_name'] = TRUE;
				$config['quality'] = '90';
			
				$this->load->library('upload', $config);
		
				if ( ! $this->upload->do_upload())
				{
					$error = array('error' => $this->upload->display_errors());
		
					$this->load->view('admincms/profile/add_profile', $error);
				}else{
				
					
					//return file name after upload
					$file_data = $this->upload->data();
					
					//resize image
						$config['image_library'] = 'gd2';
						$config['source_image']	= './private/profile/'.$file_data['file_name'];
						$config['create_thumb'] = false;
						$config['new_image'] = 'thumb_'.$file_data['file_name'];
						$config['maintain_ratio'] = TRUE;
						$config['width']	= 227;
						$config['height']	= 125;
						
						$this->load->library('image_lib', $config); 
						$this->image_lib->resize();
						//$file_data_thumb = $this->upload->data();
					//end resize image
				
					$data = array(
					   'name_ar' 		=> $this->input->post('name_ar'),
							   'description_ar' => $this->input->post('description_ar'),
							   'arrange' 		=> $this->input->post('arrange'),
							   'club_ar' 		=> $this->input->post('club_ar'),
							   'weight' 		=> $this->input->post('weight'),
							   'height' 		=> $this->input->post('height'),
							   'international_matches' 		=> $this->input->post('international_matches'),
							   'postion' 					=> $this->input->post('postion'),
							   'nationality' 		=> $this->input->post('nationality'), 
							   'show_first_page' 		=> $this->input->post('show_first_page'), 
							   'active' 		=> $this->input->post('active'), 
							   'author' 		=> $this->session->userdata('current_user'),
							   'image_name' 		=> $file_data['file_name'],
							   'image_thumb' 		=> 'thumb_'.$file_data['file_name']
					 );
						
					// get insert id  and save it in $content_id
					//$grouprofiles_id = $this->general->addData('media_group',$data);
					
					$result = $this->db->insert('player_profile', $data); 

				
				$this->session->set_flashdata('message', '<p class=\'success\'>Player Profile was successfully added.</p>');
				redirect(current_url());
			}
			}
			}
		} // end function add_profile
		
		
		function view_profile()
		{	
			
			$data['site_title'] = "View Categories";	
			$data['profile'] = $this->data_model->getTable('player_profile','player_id');
			$this->load->view('admincms/profile/view_profile', $data);

			} // end function view_post
			
		
		function delete_profile()
		{	
			$player_id = $this->uri->segment(4,0);
			$this->db->delete('player_profile', array('player_id' => $player_id)); 
			
			$this->session->set_flashdata('user_updated', '<p class=\'success\'Player Profile was successfully deleted</p>');
			redirect('admincms/profile/view_profile');
				
		} // end function delete_category
		
		
		
		function update_profile_arrange()
		{
					if($this->input->post('sbm') == "Update Arrange") { 
			
							$arrange=$_POST['arrange'];
							foreach($arrange as $player_id => $value2)
							  {
								  $data = array(
												   'arrange' 		=> $value2
												);
								  $this->db->where('player_id', $player_id);
								  $this->db->update('player_profile', $data);
								  
							 
							 }
							
							$this->session->set_flashdata('user_updated', '<p class=\'success\'>Arrange was successfully updated.</p>');
							redirect("admincms/profile/view_profile");
					}else
					{ 
						$contentid=$_POST['contentid'];
					
						 foreach($contentid as $player_id => $value2)
						  {
							  
							 	$this->db->delete('player_profile', array('player_id' => $value2)); 		
								 }
						$this->session->set_flashdata('user_updated', '<p class=\'success\'>Players Profile was successfully deleted.</p>');
						redirect("admincms/profile/view_profile");
					}
		} // end function update_category_arrange
		
		
		
		function edit_profile()
		{	
			$data['site_title'] = "Edit Player Profile";

			$id = $this->uri->segment(4,0);
			$table_name='player_profile';
			$where_id='player_id';
			$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);
			
			$this->load->view('admincms/profile/edit_profile', $data);

		} // end function edit_category
		
		function update_profile()
		{
			
			//Form Validation
			$this->form_validation->set_rules('name_ar', 'Player Name', 'trim|required|xss_clean');
	

		
			//If form validation failed, return to the form and throw out errors
			if($this->form_validation->run() == false)
			{
				//echo "errors";
				$data['site_title'] = "Update Profile";
				$id = $this->input->post('player_id');
				$table_name='player_profile';
				$where_id='player_id';
				$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);	
				$this->load->view('admincms/profile/edit_profile', $data);

			}
			else
			{
					$config['upload_path'] 			= './private/profile/';
					$config['allowed_types'] = 'gif|jpg|bmp|tiff|jpeg|png';
					$config['max_size'] = '0';
					$config['max_width']  = '0';
					$config['max_height']  = '0';
					$config['encrypt_name'] = TRUE;
					$config['quality'] = '90';
					$this->load->library('upload', $config);
						
						$this->upload->do_upload();
						$file_data = $this->upload->data();
						
						// Check if user upload new image in update
						if ($file_data['file_name'] != ""){
							
						$file_data = $this->upload->data();
					
					//resize image
						$config['image_library'] = 'gd2';
						$config['source_image']	= './private/profile/'.$file_data['file_name'];
						$config['create_thumb'] = false;
						$config['new_image'] = 'thumb_'.$file_data['file_name'];
						$config['maintain_ratio'] = TRUE;
						$config['width']	= 227;
						$config['height']	= 125;
						
						$this->load->library('image_lib', $config); 
						$this->image_lib->resize();
						
						$data = array(
							   'name_ar' => $this->input->post('name_ar'),
							   'description_ar' => $this->input->post('description_ar'),
							   'arrange' 		=> $this->input->post('arrange'),
							   'club_ar' 		=> $this->input->post('club_ar'),
							   'weight' 		=> $this->input->post('weight'),
							   'height' 		=> $this->input->post('height'),
							   'international_matches' 		=> $this->input->post('international_matches'),
							   'postion' 					=> $this->input->post('postion'),
							   'nationality' 		=> $this->input->post('nationality'), 
							   'show_first_page' 		=> $this->input->post('show_first_page'), 
							   'active' 		=> $this->input->post('active'), 
							   'author' 		=> $this->session->userdata('current_user'),
							   'image_name' 		=> $file_data['file_name'],
							   'image_thumb' 		=> 'thumb_'.$file_data['file_name']
							   
							);
								
						$player_id = $this->input->post('player_id');
						$this->db->where('player_id', $player_id);
						$this->db->update('player_profile', $data); 
						
					}else // user didnt upload new image
					{
						$data = array(
							   'name_ar' => $this->input->post('name_ar'),
							   'description_ar' => $this->input->post('description_ar'),
							   'arrange' 		=> $this->input->post('arrange'),
							   'club_ar' 		=> $this->input->post('club_ar'),
							   'weight' 		=> $this->input->post('weight'),
							   'height' 		=> $this->input->post('height'),
							   'international_matches' 		=> $this->input->post('international_matches'),
							   'postion' 					=> $this->input->post('postion'),
							   'nationality' 		=> $this->input->post('nationality'), 
							   'show_first_page' 		=> $this->input->post('show_first_page'), 
							   'active' 		=> $this->input->post('active'), 
							   'author' 		=> $this->session->userdata('current_user')
							 //  'image_name' 		=> $file_data['file_name'],
							  // 'image_thumb' 		=> 'thumb_'.$file_data['file_name']
							   
							);
						
						$player_id = $this->input->post('player_id');
						$this->db->where('player_id', $player_id);
						$this->db->update('player_profile', $data); 
						
					}
					// upload the edit view again 
				$data['site_title'] = "Edit Profile";
				$id = $this->input->post('player_id');
				$table_name='player_profile';
				$where_id='player_id';
				$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);	
				$data['update_record'] = "Profile was successfully update";	
				$this->load->view('admincms/profile/edit_profile', $data);
				
			}
		} // end function update_category	
		
		
		
	}