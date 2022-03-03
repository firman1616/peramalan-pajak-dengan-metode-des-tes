<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peramalan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// load Session Library
		$this->load->library('session');

		// load url helper
		// $this->load->helper('url');
	}

	public function index()
	{
		$data['title'] = 'DES Brown';
		$data['navigation'] = 'navigation/nav';
		$data['content'] = 'admin/form_ramal';
		$data['user'] = $this->m_data->show_data('tbl_usaha')->result();
		// $data['user2']= $this->m_data->coba3()->result();
		//$data['user2']= $this->m_data->show_data('tbl_forecast')->result();
		$data['user2'] = $this->db->query("
    		SELECT tf.tgl_peramalan, tf.alpha, tf.step1, tf.step2, tf.step3, tf.step4, tf.step5, tf.rmse, tf.id_peramalan
    		FROM tbl_peramalan tf 
    		")->result();
		$this->load->view('template/content', $data);
	}
	public function VTambah()
	{
		$data['navigation'] = 'navigation/nav';
		$data['content'] = 'admin/tambah_penjualan';
		$this->load->view('template/content', $data);
	}

	public function perhitungan()
	{
		// /*echo '<br>'.*/$idbrg = $this->input->post('kode_barang');
		/*echo '<br>'.*/
		$bln = $this->input->post('bln');
		/*echo '<br>'.*/
		$thn = $this->input->post('thn');
		/*echo '<br>'.*/
		$alp = $this->input->post('alpha');
		// if ($bln == 'Januari') {
		// 	$bln2 = '01';
		// } elseif ($bln == 'Februari') {
		// 	$bln2 = '02';
		// } elseif ($bln == 'Maret') {
		// 	$bln2 = '03';
		// } elseif ($bln == 'April') {
		// 	$bln2 = '04';
		// } elseif ($bln == 'Mei') {
		// 	$bln2 = '05';
		// } elseif ($bln == 'Juni') {
		// 	$bln2 = '06';
		// } elseif ($bln == 'Juli') {
		// 	$bln2 = '07';
		// } elseif ($bln == 'Agustus') {
		// 	$bln2 = '08';
		// } elseif ($bln == 'September') {
		// 	$bln2 = '09';
		// } elseif ($bln == 'Oktober') {
		// 	$bln2 = '10';
		// } elseif ($bln == 'November') {
		// 	$bln2 = '11';
		// } elseif ($bln == 'Desember') {
		// 	$bln2 = '12';
		// }
		//$bln2;
		// $date = $thn . '-' . $bln2 . '-01';
		$date = $thn . '-' . $bln . '-01';
		echo '<br>' . $blnmin1 = date('Y-m', strtotime("-1 months", strtotime($date)));
		echo '<br>' . $blnp = date('Y-m', strtotime($date));



		//cek data des
		$sqlcekpnj1 = $this->db->query("SELECT * FROM tbl_pendapatan ORDER BY tgl_pendapatan ASC LIMIT 1")->result();
		foreach ($sqlcekpnj1 as $pnj1) {
			echo '<br> Tanggal Pnj ' . $tglcekpnj1 = date("Y-m", strtotime($pnj1->tgl_pendapatan));
			echo '<br> Tanggal Pnj ' . $tglcekpnj2 = date("Y", strtotime($pnj1->tgl_pendapatan));
		}
		//$jmlsqlcekpnj1 = sizeof($sqlcekpnj1);
		// $sqlcek1 = $this->db->query("SELECT count(id_peramalan) as ttl FROM tbl_peramalan WHERE DATE_FORMAT(tgl_peramalan, '%Y') = '$tglcekpnj2'")->result();
		$sqlcek1 = $this->db->query("SELECT count(id_peramalan) as ttl FROM tbl_peramalan")->result();
		foreach ($sqlcek1 as $sc1) {
			# code...
			echo '<br> Jml T' . $jmlsqlcek1 = $sc1->ttl;
		}
		// if($jmlsqlcek1 > 0){
		echo '<br>ada';
		$sqlcek2 = $this->db->query("SELECT * FROM tbl_peramalan WHERE DATE_FORMAT(tgl_peramalan, '%Y-%m') = '$blnp'")->row();
		if ($sqlcek2 > 0) {
			$this->session->set_flashdata(
				'msg',
				'<div class="alert alert-danger">
                    <h4>Oppss</h4>
                    <p>Peramalan periode ini sudah dibuat.</p>
                </div>'
			);
		} else {

			$sqldtpn1 = $this->db->query("SELECT SUM(jumlah_pendapatan) as total FROM tbl_pendapatan WHERE DATE_FORMAT(tgl_pendapatan, '%Y-%m') = '$blnp'")->result();
			foreach ($sqldtpn1 as $spnj1) {
				$Ft = $spnj1->total;
			}

			// myquery
			$sqlmin1 = $this->db->query("SELECT SUM(jumlah_pendapatan) as total FROM tbl_pendapatan WHERE DATE_FORMAT(tgl_pendapatan, '%Y-%m') = '$blnmin1'")->result();
			foreach ($sqlmin1 as $row) {
				$bln_sblm = $row->total;
			}
			// end my query

			$sqldtprmin1 = $this->db->query("SELECT SUM(step1) as total FROM tbl_peramalan WHERE DATE_FORMAT(tgl_peramalan, '%Y-%m') = '$blnmin1'")->result();
			foreach ($sqldtprmin1 as $sprmin1) {
				$prmin1 = $sprmin1->total;
			}

			$sqldtprmin12 = $this->db->query("SELECT SUM(step2) as total FROM tbl_peramalan WHERE DATE_FORMAT(tgl_peramalan, '%Y-%m') = '$blnmin1'")->result();
			foreach ($sqldtprmin12 as $sprmin12) {
				$prmin12 = $sprmin12->total;
			}

			$alpmin = 1 - $alp;

			// $st1 = ($alp * $Ft) + ($alpmin * $prmin1); $st1 = ($alp * $Ft) + ($alpmin * $bln_sblm);
			echo '<br>Data Aktual = ' . $bln_sblm;
			echo '<br>S1 = ' . $st1 = ($alp * $Ft) + ($alpmin * $prmin1);
			//  $st2 = ($alp * $st1) + ($alpmin * $bln_sblm);
			echo '<br>S2 = ' . $st2 = ($alp * $st1) + ($alpmin * $prmin12);
			echo '<br>At = ' . $st3 = (2 * $st1) - $st2;
			echo '<br>Bt = ' . $st4 = ($alp / $alpmin) * ($st1 - $st2);
			echo '<br>Ft+m = ' . $st5 = $st3 + $st4;
			// $rmse = sqrt((pow(($Ft - $st5), 2) / 1));
			echo '<br>rmse = ' . $rmse = sqrt(pow(($bln_sblm - $st5), 2)) / 12;
			$x = $Ft - $st5;
			$y = $x / $Ft;
			$z = $y * 100;
			$q = $z / 12;
			echo '<br> MAPE = ' . $q;
			echo '<br>';
			echo '<br>';
			// die(var_dump($q));

			$data = array(
				'id_peramalan' => '',
				'tgl_peramalan' => $blnp . '-01',
				'alpha' => $alp,
				'data_aktual' => $Ft,
				'step1' => $st1,
				'step2' => $st2,
				'step3' => $st3,
				'step4' => $st4,
				'step5' => $st5,
				'rmse' => $rmse
			);
			$this->m_data->input_data($data, 'tbl_peramalan');
			$this->session->set_flashdata(
				'msg',
				'<div class="alert alert-success">
                    <h4>Yeayy</h4>
                    <p>Peramalan periode ini berhasil dibuat.</p>
                </div>'
			);
		}

		// }else{
		// 	echo '<br>tidak ada';
		// 	$sqldtpn1 = $this->db->query("SELECT SUM(jumlah_pendapatan) as total FROM tbl_pendapatan WHERE DATE_FORMAT(tgl_pendapatan, '%Y-%m') = '$blnp'")->result();
		// 		foreach ($sqldtpn1 as $spnj1) {
		// 			$Ft = $spnj1->total;
		// 		}
		// 		$st1 = $Ft;
		// 		$st2 = $Ft;
		// 		$st3 = (2*$Ft)-$st2;
		// 		$st4 = ($alp/(1-$alp))*($st1-$st2);
		// 		$st5 = $st3+$st4;
		// 		$rmse = sqrt((pow(($Ft-$st5),2)/1));
		// 	$data = array(
		// 		'id_peramalan' => '', 
		// 		'tgl_peramalan' => $blnp.'-01',
		// 		'alpha' => $alp,
		// 		'step1' => $st1,
		// 		'step2' => $st2,
		// 		'step3' => $st3,
		// 		'step4' => $st4,
		// 		'step5' => $st5,
		// 		'rmse' => $rmse
		// 		);
		// 	$this->m_data->input_data($data, 'tbl_peramalan');
		// 	$this->session->set_flashdata('msg', 
		//               '<div class="alert alert-success">
		//                   <h4>Yeayy</h4>
		//                   <p>Peramalan periode ini berhasil dibuat.</p>
		//               </div>'); 
		// }
		redirect('Admin/Peramalan/index');
	}

	public function hapus($id_prm)
	{
		$where = array('id_peramalan' => $id_prm);
		$this->m_data->del_data($where, 'tbl_peramalan');
		$this->session->set_flashdata(
			'msg',
			'<div class="alert alert-success">
                    <h4>Yeayy</h4>
                    <p>Peramalan periode ini berhasil dihapus.</p>
                </div>'
		);
		redirect('Admin/Peramalan/index');
	}

	public function form_ramal2()
	{
		$data['title'] = 'DES Brown';
		$data['navigation'] = 'navigation/nav';
		$data['content'] = 'admin/form_ramal2';
		$this->load->view('template/content', $data);
	}

	// public function hitung()
	// {
	// 	$bln = $this->input->post('bln');
	// 	$thn = $this->input->post('thn');
	// 	$alp = $this->input->post('alpha');

	// 	if ($bln < 10) {
	// 		$bln2 = '01-' . '0' . $bln . '-' . $thn;
	// 	} else {
	// 		$bln2 = '01-' . $bln . '-' . $thn;
	// 	}
	// 	echo '<br>Bulan Yang Diambil = ' . $bln;
	// 	echo '<br>Bln 2 = ' . $blnplus1 = date('m', strtotime("+1 month", strtotime($bln)));
	// 	echo '<br>Bln 3 = ' . $blnplus2 = date('m', strtotime("+2 month", strtotime($bln)));
	// 	die(var_dump($blnplus2));

	// 	$d_aktual = $this->db->query("SELECT tgl_pendapatan, SUM(jumlah_pendapatan) as total FROM tbl_pendapatan WHERE YEAR(tgl_pendapatan) = '$thn' AND MONTH(tgl_pendapatan) BETWEEN '01' AND '05' GROUP BY MONTH(tgl_pendapatan)")->row();
	// }
}
