<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index(){
	//$data['navigation'] = 'navigation/nav';
    //$data['content']= 'login_form';
	$this->load->view('login/index');
	// $this->load->view('login_form');
	//$this->load->view('template/footer');
	}
}
