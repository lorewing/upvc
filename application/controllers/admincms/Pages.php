<?php

	class Pages extends CI_Controller
	{
		function __construct()
		{
			
			parent:: __construct();
			$this->load->helper('cookie');
			$this->load->library('session');
			$this->load->model('membership_model');
			$this->is_logged_in();
			$this->membership_model->getKeywords('Portfolio'); // load keywords for each page based on controler name
			
		}
	
		public function index()
		{
				$data['site_title'] = "Add Media Group";
				$this->load->view('admincms/pages/add_page_category', $data);
			 
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
	
		
		function add_page_category()
		{
			
			//Form Validation
			$this->form_validation->set_rules('category_name_ar', 'Category Title', 'trim|required|xss_clean');
			
			
		
			//If form validation failed, return to the form and throw out errors
			if($this->form_validation->run() == false)
			{
				//echo "errors";
				$data['site_title'] = "Add Category";
				$this->load->view('admincms/pages/add_page_category', $data);
			}
			else
			{
			
				if (empty($_FILES['userfile']['name'])) {
							$data = array(
							   'category_name' 		=> $this->input->post('category_name_ar'),
							   'sub_cat'			=> $this->input->post('sub_cat'),
							   'arrange' 			=> $this->input->post('arrange'),
							   'meta_keywords' 		=> $this->input->post('meta_keywords'),
							   'meta_description' 	=> $this->input->post('meta_description'), 
							   'active' 			=> '1',
							   'author' 			=> $this->session->userdata('current_user')
							);
								
							// get insert id  and save it in $content_id
							//$groupages_id = $this->general->addData('media_group',$data);
							
							$result = $this->db->insert('category', $data); 
		
						
						$this->session->set_flashdata('message', '<p class=\'success\'>Category was successfully added.</p>');
						redirect(current_url());
					
				}else{
				$config['upload_path'] 			= './private/pages/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx|zip';
				$config['max_size'] = '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				$config['encrypt_name'] = TRUE;
				$config['quality'] = '90';
			
				$this->load->library('upload', $config);
		
				if ( ! $this->upload->do_upload())
				{
					$error = array('error' => $this->upload->display_errors());
		
					$this->load->view('admincms/pages/add_page_category', $error);
				}else{
				
					
					//return file name after upload
					$file_data = $this->upload->data();
					
					//resize image
						$config['image_library'] = 'gd2';
						$config['source_image']	= './private/pages/'.$file_data['file_name'];
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
					   'category_name' 		=> $this->input->post('category_name_ar'),
					   'sub_cat'			=> $this->input->post('sub_cat'),
					   'arrange' 		=> $this->input->post('arrange'),
					   'meta_keywords' 		=> $this->input->post('meta_keywords'),
					   'meta_description' 	=> $this->input->post('meta_description'), 
					   'active' 	=> '1', 
					   'author' 		=> $this->session->userdata('current_user'), 
					   'category_cover' 		=> $file_data['file_name'],
					   'category_cover_thumb' 		=> 'thumb_'.$file_data['file_name']
					 );
						
					// get insert id  and save it in $content_id
					//$groupages_id = $this->general->addData('media_group',$data);
					
					$result = $this->db->insert('category', $data); 

				
				$this->session->set_flashdata('message', '<p class=\'success\'>Category was successfully added.</p>');
				redirect(current_url());
			}
			}
			}
		} // end function add_page_category
		
		
		function view_categories()
		{	
			
			$data['site_title'] = "View Categories";	
			$data['category'] = $this->data_model->getTable('category','category_id');
			$this->load->view('admincms/pages/view_categories', $data);

			} // end function view_post
			
		
		function delete_category()
		{	
			$category_id = $this->uri->segment(4,0);
			$this->db->delete('category', array('category_id' => $category_id)); 
			
			$this->session->set_flashdata('user_updated', '<p class=\'success\'Category was successfully deleted</p>');
			redirect('admincms/pages/view_categories');
				
		} // end function delete_category
		
		
		
		function update_category_arrange()
		{
					if($this->input->post('sbm') == "Update Arrange") { 
			
							$arrange=$_POST['arrange'];
							foreach($arrange as $category_id => $value2)
							  {
								  $data = array(
												   'arrange' 		=> $value2
												);
								  $this->db->where('category_id', $category_id);
								  $this->db->update('category', $data);
								  
							 
							 }
							
							$this->session->set_flashdata('user_updated', '<p class=\'success\'>Arrange was successfully updated.</p>');
							redirect("admincms/pages/view_categories");
					}else
					{ 
						$contentid=$_POST['contentid'];
					
						 foreach($contentid as $category_id => $value2)
						  {
							  
							 	$this->db->delete('category', array('category_id' => $value2)); 		
								 }
						$this->session->set_flashdata('user_updated', '<p class=\'success\'>Category was successfully deleted.</p>');
						redirect("admincms/pages/view_categories");
					}
		} // end function update_category_arrange
		
		function update_pages_arrange()
		{
					if($this->input->post('sbm') == "Update Arrange") { 
			
							$arrange=$_POST['arrange'];
							foreach($arrange as $page_id => $value2)
							  {
								  $data = array(
												   'arrange' 		=> $value2
												);
								  $this->db->where('page_id', $page_id);
								  $this->db->update('page', $data);
								  
							 
							 }
							
							$this->session->set_flashdata('user_updated', '<p class=\'success\'>Arrange was successfully updated.</p>');
							redirect("admincms/pages/view_pages");
					}else
					{ 
						$contentid=$_POST['contentid'];
					
						 foreach($contentid as $page_id => $value2)
						  {
							  
							 	$this->db->delete('page', array('page_id' => $value2)); 		
								 }
						$this->session->set_flashdata('user_updated', '<p class=\'success\'>Pagies was successfully deleted.</p>');
						redirect("admincms/pages/view_pages");
					}
		} // end function update_category_arrange
		
		function edit_category()
		{	
			$data['site_title'] = "Edit Categories";

			$id = $this->uri->segment(4,0);
			$table_name='category';
			$where_id='category_id';
			$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);
			
			$this->load->view('admincms/pages/editcategory', $data);

		} // end function edit_category
		
		function update_category()
		{
			
			//Form Validation
			$this->form_validation->set_rules('category_name_ar', 'Category Title', 'trim|required|xss_clean');
	

		
			//If form validation failed, return to the form and throw out errors
			if($this->form_validation->run() == false)
			{
				//echo "errors";
				$data['site_title'] = "Edit Category";
				$id = $this->input->post('category_id');
				$table_name='category';
				$where_id='category_id';
				$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);	
				$this->load->view('admincms/pages/editcategory', $data);

			}
			else
			{
					$config['upload_path'] 			= './private/pages/';
					$config['allowed_types'] = 'gif|jpg|bmp|tiff|jpeg|png|pdf|doc|docx|xls|xlsx|zip';
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
						$config['source_image']	= './private/pages/'.$file_data['file_name'];
						$config['create_thumb'] = false;
						$config['new_image'] = 'thumb_'.$file_data['file_name'];
						$config['maintain_ratio'] = TRUE;
						$config['width']	= 227;
						$config['height']	= 125;
						
						$this->load->library('image_lib', $config); 
						$this->image_lib->resize();
						
						$data = array(
							   'category_name' 		=> $this->input->post('category_name_ar'),
							   'sub_cat'			=> $this->input->post('sub_cat'),
							   'arrange' 		=> $this->input->post('arrange'),
							   'meta_keywords' 		=> $this->input->post('meta_keywords'),
							   'meta_description' 	=> $this->input->post('meta_description'), 
							   'active' 	=> $this->input->post('active'),
							   'author' 		=> $this->session->userdata('current_user'), 
							   'category_cover' 		=> $file_data['file_name'],
							   'category_cover_thumb' 		=> 'thumb_'.$file_data['file_name']
							   
							);
								
						$category_id = $this->input->post('category_id');
						$this->db->where('category_id', $category_id);
						$this->db->update('category', $data); 
						
					}else // user didnt upload new image
					{
						$data = array(
							   'category_name' 		=> $this->input->post('category_name_ar'),
							    'sub_cat'			=> $this->input->post('sub_cat'),
							   'arrange' 		=> $this->input->post('arrange'),
							   'meta_keywords' 		=> $this->input->post('meta_keywords'),
							   'meta_description' 	=> $this->input->post('meta_description'), 
							   'active' 	=> $this->input->post('active') 
							  // 'author' 		=> $this->session->userdata('current_user'), 
							 //  'category_cover' 		=> $file_data['file_name'],
							 //  'category_cover_thumb' 		=> 'thumb_'.$file_data['file_name']
							   
							);
						
						$category_id = $this->input->post('category_id');
						$this->db->where('category_id', $category_id);
						$this->db->update('category', $data); 
						
					}
					// upload the edit view again 
				$data['site_title'] = "Edit Category";
				$id = $this->input->post('category_id');
				$table_name='category';
				$where_id='category_id';
				$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);	
				$data['update_record'] = "Category was successfully update";	
				$this->load->view('admincms/pages/editcategory', $data);
				
			}
		} // end function update_category	
		
		
		function add_page()
		{
			
			//Form Validation
			$this->form_validation->set_rules('title_ar', 'Page Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('category_id', 'Category Section', 'required');
			//$this->form_validation->set_rules('userfile', 'PDF File', 'required');
			
		
			//If form validation failed, return to the form and throw out errors
			if($this->form_validation->run() == false)
			{
				//echo "errors";
				$data['site_title'] = "Add Page";
				$this->load->view('admincms/pages/add_page', $data);
			}
			else
			{
			
				if (empty($_FILES['userfile']['name'])) {
							$data = array(
							   'title_ar' 		=> $this->input->post('title_ar'),
							   'arrange' 		=> $this->input->post('arrange'),
							   'category_id' 		=> $this->input->post('category_id'),
							   'active' 	 		=> $this->input->post('active'),
							   'image_name' 		=> 'default.jpg',
					  			'image_thumb' 		=> 'default_thumb.jpg',
							   'author' 		=> $this->session->userdata('current_user')
							);
								
							// get insert id  and save it in $content_id
							//$groupages_id = $this->general->addData('media_group',$data);
							
							$result = $this->db->insert('page', $data); 
		
						
						$this->session->set_flashdata('message', '<p class=\'success\'>Page was successfully added.</p>');
						redirect(current_url());
					
				}else{
						
				$config['upload_path'] 			= './private/pdf/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx|zip';
				$config['max_size'] = '0';
				//$config['max_width']  = '0';
//				$config['max_height']  = '0';
				$config['encrypt_name'] = TRUE;
//				$config['quality'] = '90';
			
				$this->load->library('upload', $config);
		
				if ( ! $this->upload->do_upload('userfile'))
				{
					$error = array('error' => $this->upload->display_errors());
		
					$this->load->view('admincms/pages/add_page', $error);
				}else{
				
					
					//return file name after upload
					$file_data = $this->upload->data();
				}
				
				$config['upload_path'] 			= './private/pages/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx|zip';
				$config['max_size'] = '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				$config['encrypt_name'] = TRUE;
				$config['quality'] = '90';
				
				//This re-initializes the upload library so that a new file type can be processed
				$this->upload->initialize($config);
				
				$this->load->library('upload', $config);
				$this->upload->do_upload('userfile2');
				
				
					
					$file_data2 = $this->upload->data();
					//resize image
						$config['image_library'] = 'gd2';
						$config['source_image']	= './private/pages/'.$file_data2['file_name'];
						$config['create_thumb'] = false;
						$config['new_image'] = 'thumb_'.$file_data2['file_name'];
						$config['maintain_ratio'] = TRUE;
						$config['width']	= 227;
						$config['height']	= 125;
						
						$this->load->library('image_lib', $config); 
						$this->image_lib->resize();
						$file_data_thumb = $this->upload->data();
					//end resize image
				
					$data = array(
					   'title_ar' 		=> $this->input->post('title_ar'),
					   'arrange' 		=> $this->input->post('arrange'),
					   'category_id' 		=> $this->input->post('category_id'),
					   'active' 	=> '1', 
					   'author' 		=> $this->session->userdata('current_user'),
					   'pdf_name' 		=> $file_data['file_name'], 
					   'image_name' 		=> $file_data2['file_name'],
					   'image_thumb' 		=> 'thumb_'.$file_data2['file_name']
					 );
						
					// get insert id  and save it in $content_id
					//$groupages_id = $this->general->addData('media_group',$data);
					
					$result = $this->db->insert('page', $data); 

				
				$this->session->set_flashdata('message', '<p class=\'success\'>Page was successfully added.</p>');
				redirect(current_url());
				
			}
			}
		} // end function add_page
		
		
			
			
			function view_pages()
		{	
			
			$data['site_title'] = "View Pages";	
			$data['page'] = $this->data_model->getTable('page','page_id');
			$this->load->view('admincms/pages/view_pages', $data);

			} // end function view_pages
			
			function delete_page()
		{	
			$page_id = $this->uri->segment(4,0);
			$this->db->delete('page', array('page_id' => $page_id)); 
			
			$this->session->set_flashdata('user_updated', '<p class=\'success\'Page was successfully deleted</p>');
			redirect('admincms/pages/view_pages');
				
		} // end function delete_page
		
		
		function edit_page()
		{	
			$data['site_title'] = "Edit Page";

			$id = $this->uri->segment(4,0);
			$table_name='page';
			$where_id='page_id';
			$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);
			
			$this->load->view('admincms/pages/edit_page', $data);

		} // end function edit_page
		
		
		
		function update_page(){
			
			//Form Validation
			$this->form_validation->set_rules('title_ar', 'Page Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('category_id', 'Category Section', 'required');
			//

		
			//If form validation failed, return to the form and throw out errors
			if($this->form_validation->run() == false)
			{
				//echo "errors";
				$data['site_title'] = "Edit Page";
				$id = $this->input->post('page_id');
				$table_name='page';
				$where_id='page_id';
				$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);	
				$this->load->view('admincms/pages/edit_page', $data);

			} // end form validation
			else
			{
				// case user didn't upload new pdf or new emage
				if(empty($_FILES['userfile']['name']) and (empty($_FILES['userfile2']['name'])))
				{
					$data = array(
					   'title_ar' 		=> $this->input->post('title_ar'),
					   'arrange' 		=> $this->input->post('arrange'),
					   'category_id' 		=> $this->input->post('category_id'),
					  'active' 	=> $this->input->post('active')
					   //'pdf_name' 		=> $file_data['file_name']
							   
							);
						
						$page_id = $this->input->post('page_id');
						$this->db->where('page_id', $page_id);
						$this->db->update('page', $data);
				}
				
				// case user upload new pdf only
				elseif(!empty($_FILES['userfile']['name']) and empty($_FILES['userfile2']['name']) )
					{
					$config['upload_path'] 			= './private/pdf/';
					$config['allowed_types'] = 'gif|jpg|bmp|tiff|jpeg|png|pdf|doc|docx|xls|xlsx|zip';
					$config['encrypt_name'] = TRUE;
					
					$this->load->library('upload', $config);
					$this->upload->do_upload('userfile');
						$file_data = $this->upload->data();
						
						// Check if user upload new image in update
						
							
						$file_data = $this->upload->data();
						
						$data = array(
					   'title_ar' 		=> $this->input->post('title_ar'),
					   'arrange' 		=> $this->input->post('arrange'),
					   'category_id' 	=> $this->input->post('category_id'),
					   'active' 		=> $this->input->post('active'),
					  'pdf_name' 		=> $file_data['file_name']
					  	);
							
						$page_id = $this->input->post('page_id');
						$this->db->where('page_id', $page_id);
						$this->db->update('page', $data); 
						
					} // End user upload new pdf only
					
					
					// case user upload new image only
					elseif(!empty($_FILES['userfile2']['name']) and empty($_FILES['userfile']['name']))
					{

						$config['upload_path'] 			= './private/pages/';
						$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx|zip';
						$config['max_size'] = '0';
						$config['max_width']  = '0';
						$config['max_height']  = '0';
						$config['encrypt_name'] = TRUE;
						$config['quality'] = '90';
				
						$this->load->library('upload', $config);
						$this->upload->do_upload('userfile2');
		
					$file_data2 = $this->upload->data();
					//resize image
						$config['image_library'] = 'gd2';
						$config['source_image']	= './private/pages/'.$file_data2['file_name'];
						$config['create_thumb'] = false;
						$config['new_image'] = 'thumb_'.$file_data2['file_name'];
						$config['maintain_ratio'] = TRUE;
						$config['width']	= 227;
						$config['height']	= 125;
						
						$this->load->library('image_lib', $config); 
						$this->image_lib->resize();
						$file_data_thumb = $this->upload->data();
				
					//end resize image
						
						$data = array(
					   'title_ar' 		=> $this->input->post('title_ar'),
					   'arrange' 		=> $this->input->post('arrange'),
					   'category_id' 		=> $this->input->post('category_id'),
					   'active' 	=> $this->input->post('active'),
					   'image_name' 		=> $file_data2['file_name'],
					   'image_thumb' 		=> 'thumb_'.$file_data2['file_name']
					  // 'pdf_name' 		=> $file_data['file_name']
					   );
							
						$page_id = $this->input->post('page_id');
						$this->db->where('page_id', $page_id);
						$this->db->update('page', $data);
					} // end user upload new image only
					
					// user upload new pdf and new image
					else
						{
					// First Upload PDF File and save the file name on $file_data
					$config['upload_path'] 			= './private/pdf/';
					$config['allowed_types'] = 'gif|jpg|bmp|tiff|jpeg|png|pdf|doc|docx|xls|xlsx|zip';
					$config['encrypt_name'] = TRUE;
					
					$this->load->library('upload', $config);
					$this->upload->do_upload('userfile');
					$file_data = $this->upload->data();
					
					
					// second upload image nd save the file name on $file_data2
					$config['upload_path'] 			= './private/pages/';
						$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx|zip';
						$config['max_size'] = '0';
						$config['max_width']  = '0';
						$config['max_height']  = '0';
						$config['encrypt_name'] = TRUE;
						$config['quality'] = '90';
				
						//This re-initializes the upload library so that a new file type can be processed
						$this->upload->initialize($config);
						
						$this->load->library('upload', $config);
						$this->upload->do_upload('userfile2');
		
					$file_data2 = $this->upload->data();
					//resize image
						$config['image_library'] = 'gd2';
						$config['source_image']	= './private/pages/'.$file_data2['file_name'];
						$config['create_thumb'] = false;
						$config['new_image'] = 'thumb_'.$file_data2['file_name'];
						$config['maintain_ratio'] = TRUE;
						$config['width']	= 227;
						$config['height']	= 125;
						
						$this->load->library('image_lib', $config); 
						$this->image_lib->resize();
						$file_data_thumb = $this->upload->data();
				
					//end resize image
						
						$data = array(
					   'title_ar' 		=> $this->input->post('title_ar'),
					   'arrange' 		=> $this->input->post('arrange'),
					   'category_id' 		=> $this->input->post('category_id'),
					   'active' 	=> $this->input->post('active'),
					   'image_name' 		=> $file_data2['file_name'],
					   'image_thumb' 		=> 'thumb_'.$file_data2['file_name'],
					   'pdf_name' 		=> $file_data['file_name']
					   );
							
						$page_id = $this->input->post('page_id');
						$this->db->where('page_id', $page_id);
						$this->db->update('page', $data);	
						} // End user upload new pdf and new image
						
					// upload the edit view again 
				$data['site_title'] = "Edit Page";
				$id = $this->input->post('page_id');
				$table_name='page';
				$where_id='page_id';
				$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);	
				$data['update_record'] = "Page was successfully update";	
				$this->load->view('admincms/pages/edit_page', $data);	
				
			} // end else for form validation
			
			}// end function update_category
			
			
			function add_competitions()
		{
			
			//Form Validation
			$this->form_validation->set_rules('title_ar', 'Page Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('category_id', 'Category Section', 'required');
			//$this->form_validation->set_rules('userfile', 'PDF File', 'required');
			
		
			//If form validation failed, return to the form and throw out errors
			if($this->form_validation->run() == false)
			{
				//echo "errors";
				$data['site_title'] = "Add Page";
				$this->load->view('admincms/pages/add_competitions', $data);
			}
			else
			{
			
				
							$data = array(
							   'title_ar' 		=> $this->input->post('title_ar'),
							   'desc_ar' 		=> $this->input->post('desc_ar'),
							   'arrange' 		=> $this->input->post('arrange'),
							   'category_id' 		=> $this->input->post('category_id'),
							   'active' 	 		=> $this->input->post('active'),
							   'image_name' 		=> 'default.jpg',
					  			'image_thumb' 		=> 'default_thumb.jpg',
							   'author' 		=> $this->session->userdata('current_user')
							);
								
							// get insert id  and save it in $content_id
							//$groupages_id = $this->general->addData('media_group',$data);
							
							$result = $this->db->insert('competitions', $data); 
		
						
						$this->session->set_flashdata('message', '<p class=\'success\'>Competitions was successfully added.</p>');
						redirect(current_url());
					
				
					
					$result = $this->db->insert('competitions', $data); 

				
				$this->session->set_flashdata('message', '<p class=\'success\'>Competitions was successfully added.</p>');
				redirect(current_url());
				
			
			}
		} // end function add_competitions
		
		function view_competitions()
		{	
			
			$data['site_title'] = "View Competitions";	
			$data['page'] = $this->data_model->getTable('competitions','page_id');
			$this->load->view('admincms/pages/view_competitions', $data);

			} // end function view_competitions
			
			function delete_competitions()
		{	
			$page_id = $this->uri->segment(4,0);
			$this->db->delete('competitions', array('page_id' => $page_id)); 
			
			$this->session->set_flashdata('user_updated', '<p class=\'success\'Cmpetitions was successfully deleted</p>');
			redirect('admincms/pages/view_competitions');
				
		} // end function delete_page
		
		
		function edit_competitions()
		{	
			$data['site_title'] = "Edit Competitions";

			$id = $this->uri->segment(4,0);
			$table_name='competitions';
			$where_id='page_id';
			$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);
			
			$this->load->view('admincms/pages/edit_competitions', $data);

		} // end function edit_page
		
		
		function update_competitions_arrange()
		{
					if($this->input->post('sbm') == "Update Arrange") { 
			
							$arrange=$_POST['arrange'];
							foreach($arrange as $page_id => $value2)
							  {
								  $data = array(
												   'arrange' 		=> $value2
												);
								  $this->db->where('page_id', $page_id);
								  $this->db->update('competitions', $data);
								  
							 
							 }
							
							$this->session->set_flashdata('user_updated', '<p class=\'success\'>Arrange was successfully updated.</p>');
							redirect("admincms/pages/view_competitions");
					}else
					{ 
						$contentid=$_POST['contentid'];
					
						 foreach($contentid as $page_id => $value2)
						  {
							  
							 	$this->db->delete('competitions', array('page_id' => $value2)); 		
								 }
						$this->session->set_flashdata('user_updated', '<p class=\'success\'>Competitions was successfully deleted.</p>');
						redirect("admincms/pages/view_competitions");
					}
		} // end function update_category_arrange
		
		
		
		function update_competitions(){
			
			//Form Validation
			$this->form_validation->set_rules('title_ar', 'Page Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('category_id', 'Category Section', 'required');
			//

		
			//If form validation failed, return to the form and throw out errors
			if($this->form_validation->run() == false)
			{
				//echo "errors";
				$data['site_title'] = "Edit Competitions";
				$id = $this->input->post('page_id');
				$table_name='competitions';
				$where_id='page_id';
				$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);	
				$this->load->view('admincms/pages/edit_competitions', $data);

			} // end form validation
			else
			{
				
					$data = array(
					   'title_ar' 		=> $this->input->post('title_ar'),
					   'desc_ar' 		=> $this->input->post('desc_ar'),
					   'arrange' 		=> $this->input->post('arrange'),
					   'category_id' 		=> $this->input->post('category_id'),
					  'active' 	=> $this->input->post('active')
					   //'pdf_name' 		=> $file_data['file_name']
							   
							);
						
						$page_id = $this->input->post('page_id');
						$this->db->where('page_id', $page_id);
						$this->db->update('competitions', $data);
				
						
					// upload the edit view again 
				$data['site_title'] = "Edit Page";
				$id = $this->input->post('page_id');
				$table_name='competitions';
				$where_id='page_id';
				$data['rows'] = $this->data_model->editTable($table_name,$where_id,$id);	
				$data['update_record'] = "Competitions was successfully update";	
				$this->load->view('admincms/pages/edit_competitions', $data);	
				
			} // end else for form validation
			
			}// end function update_category
	}