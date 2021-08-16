<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Awal extends CI_Controller {
	function __construct(){
      parent :: __construct();
			$this->load->model('M_data');
    }

	function index(){
		// $data['nav'] = 'Home';
		// $data['navigation'] = 'navigation/nav';
    // $data['content']= 'content/home_page';
    	// $data['get_data'] = $this->M_data->get_data('tbl_slideshow');
		// $this->load->view('template/content',$data);
    $this->load->view('login');
		//redirect(base_url().'Admin/Home');
	}
}

