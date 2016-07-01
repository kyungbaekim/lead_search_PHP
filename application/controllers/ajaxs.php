<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxs extends CI_Controller {

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
	 public function __construct(){
	 		parent::__construct();
	 		$this->load->model('Ajax');
	 	}

	public function index_json(){
		$start = $this->session->userdata['start']* 5;
		$data['count'] = $this->Ajax->get_leads_count();
		$data['leads'] = $this->Ajax->display_leads($start);
		echo json_encode($data);
	}

	public function index_html(){
		$start = $this->session->userdata['start']* 5;
		$data['count'] = $this->Ajax->search_by_query_count($this->input->post());
		$data['leads'] = $this->Ajax->search_by_query($start, $this->input->post());
		$this->load->view('display', $data);
	}

	public function index(){
	  $this->load->view('index');
	}

	public function search_query(){
		$start = ($_POST['page_number'] - 1) * 5;
		$data['count'] = $this->Ajax->search_by_query_count($this->input->post());
		$data['leads'] = $this->Ajax->search_by_query($start, $this->input->post());
		$this->load->view('display', $data);
		// echo json_encode($data);
	}

	public function reset_session(){
	  $this->session->sess_destroy();
	  redirect('/');
	}
}
