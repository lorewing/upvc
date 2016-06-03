<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

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
	 
	 function __construct()
		{
			
			parent:: __construct();

			
		}
	public function index()
	{
		
       // $this->load->model("message_model");

        $total= $this->db->get_where('post', array('active'=>TRUE,'title_en <>' =>''))->num_rows();
        $per_pg=3;
        $offset=$this->uri->segment(3);

        $this->load->library('pagination');
        $config['base_url'] = base_url() . "news/index/";
        $config['total_rows'] = $total;
        $config['per_page'] = $per_pg;
	$config['num_links'] = 10;
        $config['full_tag_open'] = '<ul class="clearfix">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="current"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_tag_open'] = '<li class="next">';
        $config['prev_tag_close'] = '</li>';
        
        
        $this->pagination->initialize($config);
		
		$data=array(
			'title'=>'Lorewing Web Design & Development – Toronto & Dubai',
			'keywords'=>'management solutions egypt,hr audit egypt,training solutions egypt,financial advisory services egypt,
performance management egypt,organizational development egypt,recruitment egypt,management solutions egypt,hr audit egypt,
training solutions egypt,financial advisory services egypt,performance management egypt,organizational development egypt,recruitment egypt',
			'description' =>'A Toronto web design company that offers professional custom web design, web development and search engine optimization services. Call +1-647-680-6263',
			'results' => $this->data_model->get_all_post_en($per_pg,$offset),
			'links' => $this->pagination->create_links(),
		);
		$this->load->view('site/includes/header_internal',$data);
		$this->load->view('site/includes/nav_internal');
		$this->load->view('site/en/news'); 
		$this->load->view('site/includes/sidebar');
		$this->load->view('site/includes/footer');
		
	}
	
	public function news_detalis()
	{
			$post_id = $this->uri->segment(4,0);
			
                        $urltitle = urldecode($this->uri->segment(3));
                        $main_title = $this->uri->segment(3);
			$title = str_replace('-',' ',$urltitle);
			
			
			//update the count_view filed for statistics
			$this->db->set('count_view', 'count_view+1',FALSE);
			$this->db->where('post_id', $post_id); // '1' test value here ?
			$this->db->update('post');
			
			$query = $this->db->get_where('post', array('post_id' => $post_id));
			
			$desc_data = $query->row('desc_en');
			$desc_data = strip_tags($desc_data);
			$desc = word_limiter($desc_data, 30);
                        $image_name = $query->row('image_name');
			
			
			$data=array(
			'title'=>$title,
			'keywords'=>'management solutions egypt,hr audit egypt,training solutions egypt,financial advisory services egypt,
performance management egypt,organizational development egypt,recruitment egypt,management solutions egypt,hr audit egypt,
training solutions egypt,financial advisory services egypt,performance management egypt,organizational development egypt,recruitment egypt',
		
			'rows' => $this->data_model->viewPost($post_id),
			'description' => $desc,
                        'image_name' =>  $image_name,
                        'main_title' =>  $main_title,
                        'post_id' => $post_id, 
		);
		
                
                 $this->load->view('site/includes_ar/header',$data);

		$this->load->view('site/includes_ar/nav_insite');
		$this->load->view('site/ar/news_detalis'); 
		
		$this->load->view('site/includes_ar/footer');
		}
		
	 // end news_detalis_en
	
	
	public function tag()
	{
			$title = str_replace('-',' ',$this->uri->segment(3));
			$form_search = $this->input->post('q');
			
			//$data['rows'] = $this->data_model->viewPost($post_id);
			
			$data=array(
			'title'=>$title,
			'keywords'=>'management solutions egypt,hr audit egypt,training solutions egypt,financial advisory services egypt,
performance management egypt,organizational development egypt,recruitment egypt,management solutions egypt,hr audit egypt,
training solutions egypt,financial advisory services egypt,performance management egypt,organizational development egypt,recruitment egypt',
			'description' =>'',
			 'form_search'=>$form_search,
		);
		
		 $this->load->view('site/includes/header_internal',$data);
                        $this->load->view('site/includes/nav_internal');
			$this->load->view('site/en/tag'); 
                        $this->load->view('site/includes/sidebar');
                        $this->load->view('site/includes/footer');
		
	} // end tag
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */