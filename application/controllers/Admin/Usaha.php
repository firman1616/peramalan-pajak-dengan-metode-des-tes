<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usaha extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Master Wajib Data Pajak';
		$data['navigation'] = 'navigation/nav';
		$data['content'] = 'admin/data_usaha';
		$data['user'] = $this->m_data->show_data('tbl_usaha')->result();
		$data['usaha'] = $this->m_data->data_usaha();
		$this->load->view('template/content', $data);
	}
	public function VTambah()
	{
		$data['navigation'] = 'navigation/nav';
		$data['content'] = 'admin/tambah_usaha';
		$this->load->view('template/content', $data);
	}
	public function Tambah_data()
	{
		$id_usaha = $this->input->post('id_usaha');
		$nama_usaha = $this->input->post('nama_usaha');
		$data = array(
			'id_usaha' => $id_usaha,
			'nama_usaha' => $nama_usaha
		);
		$this->m_data->input_data($data, 'tbl_usaha');
		$this->session->set_flashdata(
			'msg',
			'<div class="alert alert-success">
                    <h4>Yeayy</h4>
                    <p>Usaha berhasil disimpan.</p>
                </div>'
		);
		redirect('index.php/admin/usaha');
	}
	public function Edit_data($idu)
	{
		$data['navigation'] = 'navigation/nav';
		$data['content'] = 'admin/edit_usaha';
		$where = array('id_usaha' => $idu);
		$data['user'] = $this->m_data->edit_data($where, 'tbl_usaha');
		$this->load->view('template/content', $data);
	}
	public function Update_data($idu)
	{
		$id_usaha = $this->input->post('id_usaha');
		$nama_usaha = $this->input->post('nama_usaha');
		$data = array(
			'id_usaha' => $id_usaha,
			'nama_usaha' => $nama_usaha
		);
		$where = array('id_usaha' => $idu);
		$this->m_data->Update_data($where, $data, 'tbl_usaha');
		$this->session->set_flashdata(
			'msg',
			'<div class="alert alert-success">
                    <h4>Yeayy</h4>
                    <p>Pendapatan berhasil diubah.</p>
                </div>'
		);
		redirect('index.php/admin/usaha');
	}
	public function hapus_data($idu)
	{
		$where = array('id_usaha' => $idu);
		$this->m_data->del_data($where, 'tbl_usaha');
		$this->session->set_flashdata(
			'msg',
			'<div class="alert alert-success">
                    <h4>Yeayy</h4>
                    <p>Pendapatan berhasil dihapus.</p>
                </div>'
		);
		redirect('index.php/admin/usaha');
	}
}
