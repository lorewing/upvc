<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function index($year = null, $month = null){
				$this->load->model('Mycal_model');

           
				 if (!$year) {
			$year = date('Y');
		}
		if (!$month) {
			$month = date('m');
		}
		
		$this->load->model('Mycal_model');
		
		//$data['calendar_small'] = $this->Mycal_model->generate_small($year, $month);
		
		$this->load->model('Mycal_model');
		
		if ($day = $this->input->post('day')) {
			$this->Mycal_model->add_calendar_data(
				"$year-$month-$day",
				$this->input->post('data')
			);
		}
		
		$data['calendar'] = $this->Mycal_model->generate_home($year, $month);
	
		
		$data=array(
			'title'=>'يو بي في سي“ الاختصاص الاوروبي',
			'keywords'=>'upvc,يو بي في سي,الاختصاص الاوروبي',
			'description' =>'',
			//'calendar_small' => $this->Mycal_model->generate_small($year, $month),
			'calendar_small' => $this->Mycal_model->generate_home($year, $month),
		          );
		
		$this->load->view('site/includes_ar/header',$data);

		$this->load->view('site/includes_ar/nav');
                
		$this->load->view('site/ar/home_ar'); 
		
		$this->load->view('site/includes_ar/footer');
		}
	
	
		
}
