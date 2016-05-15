<?php

	class Ads extends CI_Controller
	{
		function __construct()
		{
			
			parent:: __construct();
			$this->load->helper('cookie');
			$this->load->library('session');
			$this->load->model('membership_model');
			$this->is_logged_in();
			
		}
	
		public function index()
		{
				$data['site_title'] = "Add Ads";
				$this->load->view('admincms/ads/add_ads', $data);
			 
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
	
		
		
		
		function add_ads()
		{
			
			//Form Validation
			$this->form_validation->set_rules('group_name', 'Ads Title', 'trim|xss_clean');
			//$this->form_validation->set_rules('group_name_en', 'Ads Title English', 'trim|required|xss_clean');
//			$this->form_validation->set_rules('group_desc', 'Ads Description', 'trim|xss_clean');
//			$this->form_validation->set_rules('group_desc_en', 'Ads Description English', 'trim|xss_clean');
//			$this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
//			$this->form_validation->set_rules('ads_url', 'Related Tag', 'trim|xss_clean');
			
		
			//If form validation failed, return to the form and throw out errors
			if($this->form_validation->run() == false)
			{
				//echo "errors";
				$data['site_title'] = "Add Ads";
				$this->load->view('admincms/ads/add_ads', $data);
			}
			else
			{
				if (empty($_FILES['userfile']['name'])) {
						$data = array(
					   'group_name' 		=> $this->input->post('group_name'),
					 //  'group_name_en' 		=> $this->input->post('group_name_en'),
// 					   'group_desc' 	=> $this->input->post('group_desc'), 
//					   'group_desc_en' 	=> $this->input->post('group_desc_en'), 
					//   'album_cover' 		=> $file_data['file_name'],
					 //  'album_cover_thumb' 		=> 'thumb_'.$file_data['file_name'],
					   'group_type' 		=> $this->input->post('type'),  
					   'count_view' 		=> '0',
					   'author' 		=> $this->session->userdata('current_user'),
					   'arrange' 		=> $this->input->post('arrange'), 
					   'active' 	=> $this->input->post('active'),     
					   'ads_url' 		=> $this->input->post('ads_url')
					   
					);

				$result = $this->db->insert('ads', $data); 
				$this->session->set_flashdata('message', '<p class=\'success\'>Ads was successfully added.</p>');
				redirect(current_url());
				
				}else{
				
			    //$config['upload_path'] 			= './application/uploads/';
				$config['upload_path'] 			= './private/ads/';
				$config['allowed_types'] = 'gif|jpg|bmp|tiff|jpeg|png';
				$config['max_size'] = '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				$config['encrypt_name'] = TRUE;
				$config['quality'] = '90';
			
				$this->load->library('upload', $config);
		
				if ( ! $this->upload->do_upload())
				{
					$error = array('error' => $this->upload->display_errors());
		
					$this->load->view('admincms/ads/add_ads', $error);
				}else{
				/* else
				{ */
					
					//return file name after upload
					$file_data = $this->upload->data();
					
					//resize image
						$config['image_library'] = 'gd2';
						$config['source_image']	= './private/ads/'.$file_data['file_name'];
						$config['create_thumb'] = false;
						$config['new_image'] = 'thumb_'.$file_data['file_name'];
						$config['maintain_ratio'] = TRUE;
						$config['width']	= 340;
						$config['height']	= 200;
						
						$this->load->library('image_lib', $config); 
						$this->image_lib->resize();
						//$file_data_thumb = $this->upload->data();
					//end resize image
					
					$data = array(
					   'group_name' 		=> $this->input->post('group_name'),
					   'album_cover' 		=> $file_data['file_name'],
					   'album_cover_thumb' 		=> 'thumb_'.$file_data['file_name'],
					   'group_type' 		=> $this->input->post('type'),  
					   'arrange' 		=> $this->input->post('arrange'), 
					   'active' 	=> $this->input->post('active'),
					   'count_view' 		=> '0',
					   'author' 		=> $this->session->userdata('current_user'),     
					   'ads_url' 		=> $this->input->post('ads_url')
					   
					);
						
					
					$result = $this->db->insert('ads', $data); 

					
				
				$this->session->set_flashdata('message', '<p class=\'success\'>Ads was successfully added.</p>');
				redirect(current_url());
		    	} 
			}
			}
		} // end function add_ads
		
		
		
		
		function view_ads()
		{	
			
			$data['site_title'] = "View Ads";
			$tableFrom = 'ads';
			$orderby = 'arrange';
//			$tableTo = 'ads_group';
//			$tableFromID = 'ads_group_id';
//			$tableToId = 'ads_group.group_id';
			//$data['ads'] = $this->data_model->getJoinTable($tableFrom,$tableTo,$tableFromID,$tableToId);
			$data['ads'] = $this->data_model->getTable($tableFrom,$orderby);
			
			$this->load->view('admincms/ads/view_ads', $data);

			} // end function main_menu
			
			
			function delete_ads()
		{	
			$group_id = $this->uri->segment(4,0);
			$this->db->delete('ads', array('group_id' => $group_id)); 
			
			$this->session->set_flashdata('user_updated', '<p class=\'success\'>Ads was successfully deleted</p>');
			redirect('admincms/ads/view_ads');
				
		} // end function delete_Adss
		
		
		function update_category_arrange()
		{
					if($this->input->post('sbm') == "Update Arrange") { 
			
							$arrange=$_POST['arrange'];
							foreach($arrange as $group_id => $value2)
							  {
								  $data = array(
												   'arrange' 		=> $value2
												);
								  $this->db->where('group_id', $group_id);
								  $this->db->update('ads', $data);
								  
							 
							 }
							
							$this->session->set_flashdata('user_updated', '<p class=\'success\'>Arrange was successfully updated.</p>');
							redirect("admincms/ads/view_ads");
					}else
					{ 
						$contentid=$_POST['contentid'];
					
						 foreach($contentid as $group_id => $value2)
						  {
							  
							 	$this->db->delete('ads', array('group_id' => $value2)); 		
								 }
						$this->session->set_flashdata('user_updated', '<p class=\'success\'>Category was successfully deleted.</p>');
						redirect("admincms/ads/view_ads");
					}
		} // end function update_category_arrange
		
		
		function edit_ads()
		{	
			$data['site_title'] = "Edit Ads";

			$id = $this->uri->segment(4,0);
			$table_name='ads';
			$where_id='group_id';
			$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);
			
			$this->load->view('admincms/ads/edit_ads', $data);

		} // end function edit_post
		
		
			function update_ads()
		{
			
			//Form Validation
			$this->form_validation->set_rules('group_name', 'Ads Name', 'trim|xss_clean');
	

		
			//If form validation failed, return to the form and throw out errors
			if($this->form_validation->run() == false)
			{
				//echo "errors";
				$data['site_title'] = "Edit Ads";
				$id = $this->input->post('group_id');
				$table_name='ads';
				$where_id='group_id';
				$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);	
				$this->load->view('admincms/ads/edit_ads', $data);

			}
			else
			{
					$config['upload_path'] 			= './private/ads/';
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
						$config['source_image']	= './private/ads/'.$file_data['file_name'];
						$config['create_thumb'] = false;
						$config['new_image'] = 'thumb_'.$file_data['file_name'];
						$config['maintain_ratio'] = TRUE;
						$config['width']	= 340;
						$config['height']	= 200;
						
						$this->load->library('image_lib', $config); 
						$this->image_lib->resize();
						
						$data = array(
					   'group_name' 		=> $this->input->post('group_name'),
					   'album_cover' 		=> $file_data['file_name'],
					   'album_cover_thumb' 		=> 'thumb_'.$file_data['file_name'],
					   'group_type' 		=> $this->input->post('type'),  
					   'arrange' 		=> $this->input->post('arrange'), 
					   'active' 	=> $this->input->post('active'),
					   'author' 		=> $this->session->userdata('current_user'),     
					   'ads_url' 		=> $this->input->post('ads_url')
							   
							);
								
						$group_id = $this->input->post('group_id');
						$this->db->where('group_id', $group_id);
						$this->db->update('ads', $data); 
						
					}else // user didnt upload new image
					{
						$data = array(
					   'group_name' 		=> $this->input->post('group_name'),
		   			   'group_type' 		=> $this->input->post('type'),  
					   'arrange' 		=> $this->input->post('arrange'), 
					   'active' 	=> $this->input->post('active'),
					  'author' 		=> $this->session->userdata('current_user'),     
					   'ads_url' 		=> $this->input->post('ads_url')
							   
							);
						
						$group_id = $this->input->post('group_id');
						$this->db->where('group_id', $group_id);
						$this->db->update('ads', $data); 
						
					}
					// upload the edit view again 
				$data['site_title'] = "Edit Category";
				$id = $this->input->post('group_id');
				$table_name='ads';
				$where_id='group_id';
				$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);	
				$data['update_record'] = "Category was successfully update";	
				$this->load->view('admincms/ads/edit_ads', $data);
				
			}
		} // end function update_media_group
				
	}