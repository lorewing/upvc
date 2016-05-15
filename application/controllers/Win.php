<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Win extends CI_Controller {

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
	 
	public function index(){
          $data=array(
			'title'=>'يو بي في سي“ الاختصاص الاوروبي',
			'keywords'=>'upvc,يو بي في سي,الاختصاص الاوروبي',
			'description' =>'',
		          );
		
		$this->load->view('site/includes_ar/header',$data);

		$this->load->view('site/includes_ar/nav_insite');
		$this->load->view('site/ar/win'); 
		
		$this->load->view('site/includes_ar/footer');
		}
}
