<?php
defined('BASEPATH') or exit('No direct script access allowed');


//$this->load->library('Excel'); //load librari excel

class Pendapatan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// $this->load->model('M_index'); // load model m_index
		$this->load->library('Excel'); //load librari excel

	}

	// public function index()
	// {
	// 	$data['navigation'] = 'navigation/nav';
	// 	$data['content'] = 'admin/data_pendapatan';
	// 	$data['ush'] = $this->m_data->show_data('tbl_usaha')->result();
	// 	//$data['user']= $this->m_data->show_data('tbl_penjualan1')->result();
	// 	$data['user'] = $this->db->query("
	// 		SELECT tp.id_pendapatan, tp.tgl_pendapatan, tp.id_usaha, tb.nama_usaha, SUM(tp.jumlah_pendapatan) as ttl
	// 		FROM tbl_pendapatan tp 
	// 		JOIN tbl_usaha tb ON tb.id_usaha = tp.id_usaha
	// 		GROUP BY DATE_FORMAT(tp.tgl_pendapatan,'%m%Y'), tb.nama_usaha")->result();
	// 	$this->load->view('template/content', $data);
	// }
	public function index()
	{
		$data['title'] = 'Tambah Data Pendapatan Wajib Pajak';
		$data['navigation'] = 'navigation/nav';
		// $data['content']= 'admin/data_pendapatan';
		$data['content'] = 'admin/tambah_pendapatan';
		$data['ush'] = $this->m_data->show_data('tbl_usaha')->result();
		//$data['user']= $this->m_data->show_data('tbl_penjualan1')->result();
		// $data['user'] = $this->db->query("SELECT tp.id_pendapatan, tp.tgl_pendapatan, tp.id_usaha, tb.nama_usaha, SUM(tp.jumlah_pendapatan) as ttl
		// 	FROM tbl_pendapatan tp 
		// 	JOIN tbl_usaha tb ON tb.id_usaha = tp.id_usaha
		// 	GROUP BY DATE_FORMAT(tp.tgl_pendapatan,'%m%Y'), tb.nama_usaha")->result();
		$this->load->view('template/content', $data);
		// WHERE tp.id_usaha = 0
	}

	// public function VTambah()
	// {
	// 	$data['navigation'] = 'navigation/nav';
	// 	$data['content'] = 'admin/tambah_pendapatan';
	// 	$data['user'] = $this->m_data->show_data('tbl_usaha')->result();
	// 	$this->load->view('template/content', $data);
	// }
	public function Tambah_data()
	{
		$tgl_pendapatan =  $this->input->post('tgl_pendapatan');
		$id_usaha = $this->input->post('id_usaha');
		$pieces = explode("*", $id_usaha);
		$kd = $pieces[0];
		$nm = $pieces[1];
		$jumlah = $this->input->post('jumlah');
		$data = array(
			'tgl_pendapatan' => $tgl_pendapatan,
			'id_usaha' => $kd,
			'jumlah_pendapatan' => $jumlah
		);
		$this->m_data->input_data($data, 'tbl_pendapatan');
		$this->session->set_flashdata(
			'msg',
			'<div class="alert alert-success">
                    <h4>Yeayy</h4>
                    <p>Pendapatan berhasil disimpan.</p>
                </div>'
		);
		redirect('admin/Pendapatan');
	}
	public function Edit_data($idpnd)
	{
		$data['navigation'] = 'navigation/nav';
		$data['content'] = 'admin/edit_pendapatan';
		$where = array('id_pendapatan' => $idpnd);
		$data['user2'] = $this->m_data->show_data('tbl_usaha')->result();
		$data['user'] = $this->m_data->edit_data($where, 'tbl_pendapatan');
		$this->load->view('template/content', $data);
	}
	public function Update_data($idpnd)
	{
		$tgl_pendapatan =  $this->input->post('tgl_pendapatan');
		$id_usaha = $this->input->post('id_usaha');
		$pieces = explode("*", $id_usaha);
		$kd = $pieces[0];
		$nm = $pieces[1];
		$jumlah = $this->input->post('jumlah');
		$data = array(
			// 'periode' => $periode,
			'id_usaha' => $kd,
			'jumlah_pendapatan' => $jumlah
		);
		$where = array('id_pendapatan' => $idpnd);
		$this->m_data->Update_data($where, $data, 'tbl_pendapatan');
		$this->session->set_flashdata(
			'msg',
			'<div class="alert alert-success">
                    <h4>Yeayy</h4>
                    <p>Pendapatan berhasil diubah.</p>
                </div>'
		);
		redirect('admin/Pendapatan');
	}
	public function hapus_data($idpnd)
	{
		$tgl = substr($idpnd, -7);
		$id = substr($idpnd, 0, -7);
		// $where = array('id_pendapatan' => $idpnd);
		// $this->m_data->del_data($where, 'tbl_pendapatan');
		$this->db->query("DELETE FROM tbl_pendapatan WHERE id_usaha = '$id' AND DATE_FORMAT(tgl_pendapatan,'%m-%Y') = '$tgl'");
		$this->session->set_flashdata(
			'msg',
			'<div class="alert alert-success">
                    <h4>Yeayy</h4>
                    <p>Pendapatan berhasil dihapus.</p>
                </div>'
		);
		redirect('admin/Pendapatan');
	}

	public function import()
	{
		$id_usaha = $this->input->post('id_usaha');
		$config['upload_path'] = './assets/';
		$config['allowed_types'] = 'xlsx|xls';

		$this->load->library('upload');
		$this->upload->initialize($config);

		if (!$this->upload->do_upload()) {
			$this->session->set_flashdata("gagal", "<center><strong>Import Data GAGAL !!!</strong></center>");
			redirect('Pendapatan');
			// print_r('gagal');
		} else {
			$data = array('upload_data' => $this->upload->data());
			$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
			$filename = $upload_data['file_name'];

			$date = date('Y-m-d H:i:s');
			ini_set('memory_limit', '-1');
			$inputFileName = './assets/' . $filename;
			try {
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
			} catch (Exception $e) {
				//die('Error loading file :' . $e->getMessage());
			}
			error_reporting(0);
			ini_set('display_errors', 0);

			$worksheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
			$numRows = count($worksheet);

			for ($i = 2; $i < ($numRows + 1); $i++) {

				$ins = array(
					"id_usaha"			 	=> $id_usaha,
					"tgl_pendapatan"      	=> $worksheet[$i]["B"],
					"jumlah_pendapatan"    	=> $worksheet[$i]["C"]
				);
				$this->db->insert('tbl_pendapatan', $ins);
			}

			//$this->M_data->upload_data_sumber_hidup($filename);
			unlink('./assets/' . $filename);
			$this->session->set_flashdata(
				'msg',
				'<div class="alert alert-success">
                    <h4>Yeayy</h4>
                    <p>Pendapatan berhasil disimpan.</p>
                </div>'
			);
			redirect('Pendapatan');
		}
		// print_r('proses');
		//semang
	}

	public function sumber_hidup()
	{
		$data['title'] = 'Data Pendapatan RM Sumber Hidup';
		$data['navigation'] = 'navigation/nav';
		$data['content'] = 'admin/sumber_hidup';
		$data['sh'] = $this->db->query("SELECT tp.id_pendapatan, tp.tgl_pendapatan, tp.id_usaha, tb.nama_usaha, SUM(tp.jumlah_pendapatan) as ttl
    		FROM tbl_pendapatan tp 
    		JOIN tbl_usaha tb ON tb.id_usaha = tp.id_usaha
			WHERE tp.id_usaha = 0
    		GROUP BY DATE_FORMAT(tp.tgl_pendapatan,'%m%Y'), tb.nama_usaha")->result();
		$this->load->view('template/content', $data);
	}

	public function brewok()
	{
		$data['title'] = 'Data Pendapatan RM Brewok';
		$data['navigation'] = 'navigation/nav';
		$data['content'] = 'admin/ayam_brewok';
		$data['bw'] = $this->db->query("SELECT tp.id_pendapatan, tp.tgl_pendapatan, tp.id_usaha, tb.nama_usaha, SUM(tp.jumlah_pendapatan) as ttl
    		FROM tbl_pendapatan tp 
    		JOIN tbl_usaha tb ON tb.id_usaha = tp.id_usaha
			WHERE tp.id_usaha = 3
    		GROUP BY DATE_FORMAT(tp.tgl_pendapatan,'%m%Y'), tb.nama_usaha")->result();
		$this->load->view('template/content', $data);
	}

	public function amanis()
	{
		$data['title'] = 'Data Pendapatan RM Amanis';
		$data['navigation'] = 'navigation/nav';
		$data['content'] = 'admin/amanish';
		$data['am'] = $this->db->query("SELECT tp.id_pendapatan, tp.tgl_pendapatan, tp.id_usaha, tb.nama_usaha, SUM(tp.jumlah_pendapatan) as ttl
    		FROM tbl_pendapatan tp 
    		JOIN tbl_usaha tb ON tb.id_usaha = tp.id_usaha
			WHERE tp.id_usaha = 4
    		GROUP BY DATE_FORMAT(tp.tgl_pendapatan,'%m%Y'), tb.nama_usaha")->result();
		$this->load->view('template/content', $data);
	}
}
