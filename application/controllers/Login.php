<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function index()
	{
		//$data['navigation'] = 'navigation/nav';
		//$data['content']= 'login_form';
		$this->load->view('login/index');
		// $this->load->view('login_form');
		//$this->load->view('template/footer');
	}

	public function login_form()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// admin
		$where1 = array(
			'username' => $username,
			'password' => $password,
		);
		$cek1 = $this->M_data->get_data_by_id("pengguna", $where1);

		if ($cek1->num_rows() > 0) {
			foreach ($cek1->result() as $row) {
				$id = $row->id_pengguna;
				$nama = $row->nama_pengguna;
			}
			$data_session = array(
				'status' 	=> true,
				'id'		=> $id,
				'nama'		=> $nama,

			);
			$this->session->set_userdata($data_session);
			redirect(base_url("admin/Home"));
		} else {
			$this->session->set_flashdata('flash', 'Salah');
			redirect(base_url('Login'));
		}
	}
}
