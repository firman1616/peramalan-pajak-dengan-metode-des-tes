<?php
	class auth extends CI_controller {

		function __construct(){
			parent::__construct();
			$this->load->model('model_login');
		} 

		function login_form (){
			 	// proses login disini
			 	$username = $this->input->post('username');
			 	$password = $this->input->post('password');
			 	//$us = '';
			 	$hasil = $this->model_login->login($username,$password)->result();
			 	foreach ($hasil as $k) {
			 		$id = $k->id_pengguna;
			 		$us = $k->username_pengguna;
			 		$nm = $k->nama_pengguna;
			 		$ak = $k->akses_pengguna;
			 	}
			 	if ($ak=='administrator') {
			 		$this->session->set_userdata(
			 			array(
			 				'id'=>$id,
			 				'us'=>$us,
			 				'nm'=>$nm,
			 				'ak'=>$ak,
			 				'status_login'=>'oke'
			 			));
			 		redirect('Admin/Home');
			 	}else{
			 		//$this->session->set_userdata('notif','1');
			 		$this->load->view('login/index');
			 	}
			 		  
		}

		function logout (){
			$this->session->sess_destroy();
			redirect('Login');
		}
	}
