
<?php

class Contact extends CI_Controller {
               
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
			'title'=>'Contact Us - Expert Management Solutions',
			'keywords'=>'management solutions egypt,hr audit egypt,training solutions egypt,financial advisory services egypt,
performance management egypt,organizational development egypt,recruitment egypt',
			'description' =>'Expert Management Solutions - We have the tools and skills to help you select, train and retain the right employees.',
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
						
				$captcha_check = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcaniETAAAAAPMQEHDuP_WC4-K_Dlra8DNhNYF2&&response='{$response}");
					   
				 if($captcha_check.'success' == false)
				  {
					  $error['captcha'] = "captcha";
				  }
			}
			
			
			$config = Array(
			'protocol' => 'smtp',
                        'smtp_host' => 'mail.xm-solutions.net',
			'smtp_port' => 25,
			'smtp_user' => 'info@xm-solutions.net',
			'smtp_pass' => 'info-2016',
			'mailtype'  => 'html', 
			'charset' => 'utf-8',
			'wordwrap' => TRUE
   				 );
   		 $this->load->library('email', $config);
		 
			
			$this->email->from('info@xm-solutions.net', 'xm-solutions.net - Contact Us page');
			$this->email->to('lorewing2006@gmail.com'); 
                       // $this->email->cc('reem.mhd@gmail.com');
                      //  $this->email->bcc('ahmed@lorewing.com');
			$this->email->reply_to($this->input->post('email'));  
			
			$this->email->set_mailtype('html');
			
			$this->email->subject("Expert Management Solutions - Contact Us page");
			
			$name = $this->input->post('name');
			$email = $this->input->post('email');
		//	$subject = $this->input->post('subject');
			$phone = $this->input->post('phone');
			$message = nl2br($this->input->post('message')); //nl2br for add line in text box


			$data = array( 'name' => $name , 'email' => $email,'subject' => $subject,'phone' => $phone , 'message' => $message  );
			$email = $this->load->view('site/en/email/contact-us', $data, TRUE);
			$this->email->message( $email );
			$this->email->send();
			

				$this->session->set_flashdata('message', '<p class=\'success\'>Message was send successfully.</p>');
				redirect(current_url());
			}
	}
	
	
	
	
}
?>