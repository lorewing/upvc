
<?php

class Contact_us extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Data_model');
	}	
	
	function index()
	{			
		//Form Validation
			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
			//$this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
			$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
			$this->form_validation->set_rules('g-recaptcha-response', 'Recaptcha', 'required');			


		/*	$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|is_unique[user.user_email]');
		*/
			//If form validation failed, return to the form and throw out errors
			if($this->form_validation->run() == false)
			{
				$data=array(
			'title'=>'يو بي في سي“ الاختصاص الاوروبي-إتصل بنا',
			'keywords'=>'',
			'description' =>'',
                                     );
			
			$this->load->view('site/includes_ar/header',$data);
                        $this->load->view('site/includes_ar/nav_insite');
                        $this->load->view('site/ar/contact_us'); 
                        $this->load->view('site/includes_ar/footer');
				
			}
			else
			{
				if($_POST['g-recaptcha-response'])
			{
				//echo $_POST['g-recaptcha-response'];
				//die();
				$response = $_POST['g-recaptcha-response'];
						
				$captcha_check = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeUxSETAAAAAKeAom5Q0G1Q87J1tNMg-6CGYrdM&&response='{$response}");
					   
				 if($captcha_check.'success' == false)
				  {
					  $error['captcha'] = "captcha";
				  }
			}
			
			
			$config = Array(
			'protocol' => 'smtp',
                        'smtp_host' => 'mail.euroupvc.com',
			'smtp_port' => 25,
			'smtp_user' => 'euroupvc@euroupvc.com',
			'smtp_pass' => 'euroupvc44515215',
			'mailtype'  => 'html', 
			'charset' => 'utf-8',
			'wordwrap' => TRUE
   				 );
   		 $this->load->library('email', $config);
		 
			
			$this->email->from('euroupvc@euroupvc.com', 'euroupvc.com - Contact Us page');
			$this->email->to('euroupvc@euroupvc.com'); 
                        $this->email->cc('mostafaemam82@gmail.com');
                       $this->email->bcc('ahmed@lorewing.com');
			$this->email->reply_to($this->input->post('email'));  
			
			$this->email->set_mailtype('html');
			
			$this->email->subject("يو بي في سي“ الاختصاص الاوروبي-إتصل بنا");
			
			$name = $this->input->post('name');
			$email = $this->input->post('email');
		//	$subject = $this->input->post('subject');
			$phone = $this->input->post('phone');
			$message = nl2br($this->input->post('message')); //nl2br for add line in text box


			$data = array( 'name' => $name , 'email' => $email,'subject' => $subject,'phone' => $phone , 'message' => $message  );
			$email = $this->load->view('site/ar/email/contact-us', $data, TRUE);
			$this->email->message( $email );
			$this->email->send();
			

				$this->session->set_flashdata('message', '<p class=\'success\'>Message was send successfully.</p>');
				redirect(current_url());
			}
	}
	
	
	
	
}
?>