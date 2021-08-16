<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peramalan_winter extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
        // load url helper
        // $this->load->helper('url');
    }

	public function index(){
		$data['navigation'] = 'navigation/nav';
    	$data['content']= 'admin/form_ramal_winter';
    	$data['user']= $this->m_data->show_data('tbl_usaha')->result();
			// $data['user2']= $this->m_data->coba3()->result();
		//$data['user2']= $this->m_data->show_data('tbl_forecast')->result();
		$data['user2'] = $this->db->query("
    		SELECT tf.tgl_peramalan_winter, tf.alpha_winter, tf.abg_winter, tf.st_winter, tf.bt_winter, tf.lt_winter, tf.ftm_winter, tf.rmse_winter, tf.id_peramalan_winter
    		FROM tbl_peramalan_winter tf 
    		")->result();
		$this->load->view('template/content',$data);
	}
	public function VTambah(){
		$data['navigation'] = 'navigation/nav';
    	$data['content']= 'admin/tambah_penjualan';
		$this->load->view('template/content',$data);
	}

	public function perhitungan(){
		// /*echo '<br>'.*/$idbrg = $this->input->post('kode_barang');
		$bln = $this->input->post('bln');
		$blnplus1 = date('m', strtotime("+1 months", strtotime($bln)));
		$blnplus2 = date('m', strtotime("+2 months", strtotime($bln)));
		/*echo '<br>'.*/$thn = $this->input->post('thn');
		/*echo '<br>'.*/$alp = $this->input->post('alpha');
		/*echo '<br>'.*/$alpmin = 1-$alp;
		// if($bln == 'Januari'){
		// 	$bln2 = '01';
		// }elseif($bln == 'Februari'){
		// 	$bln2 = '02';
		// }elseif($bln == 'Maret'){
		// 	$bln2 = '03';
		// }elseif($bln == 'April'){
		// 	$bln2 = '04';
		// }elseif($bln == 'Mei'){
		// 	$bln2 = '05';
		// }elseif($bln == 'Juni'){
		// 	$bln2 = '06';
		// }elseif($bln == 'Juli'){
		// 	$bln2 = '07';
		// }elseif($bln == 'Agustus'){
		// 	$bln2 = '08';
		// }elseif($bln == 'September'){
		// 	$bln2 = '09';
		// }elseif($bln == 'Oktober'){
		// 	$bln2 = '10';
		// }elseif($bln == 'November'){
		// 	$bln2 = '11';
		// }elseif($bln == 'Desember'){
		// 	$bln2 = '12';
		// }
		//$bln2;
		// $date = $thn.'-'.$bln2.'-01';
		// echo '<br>'.$blnmin1 = date('Y-m', strtotime("-1 months", strtotime($date)));
		// echo '<br>'.$blnp = date('Y-m', strtotime($date));

		// if($bln == 1){
		// $sqlcekpnj = $this->db->query("SELECT COUNT(DISTINCT MONTH(tgl_pendapatan)) as tgl FROM tbl_pendapatan WHERE YEAR(tgl_pendapatan) = '$thn'")->row();
		// $cpnd = $sqlcekpnj->tgl;
		// }elseif($bln == 4){
		// $sqlcekpnj = $this->db->query("SELECT COUNT(DISTINCT MONTH(tgl_pendapatan)) as tgl FROM tbl_pendapatan WHERE YEAR(tgl_pendapatan) = '$thn'")->row();
		// $cpnd = $sqlcekpnj->tgl;
		// }elseif($bln == 7){
		// $sqlcekpnj = $this->db->query("SELECT COUNT(DISTINCT MONTH(tgl_pendapatan)) as tgl FROM tbl_pendapatan WHERE YEAR(tgl_pendapatan) = '$thn'")->row();
		// $cpnd = $sqlcekpnj->tgl;
		// }elseif($bln == 10){
		// $sqlcekpnj = $this->db->query("SELECT COUNT(DISTINCT MONTH(tgl_pendapatan)) as tgl FROM tbl_pendapatan WHERE YEAR(tgl_pendapatan) = '$thn'")->row();
		// $cpnd = $sqlcekpnj->tgl;
		// }

		$sqlcekpnj = $this->db->query("SELECT COUNT(DISTINCT MONTH(tgl_pendapatan)) as tgl FROM tbl_pendapatan WHERE YEAR(tgl_pendapatan) = '$thn' AND MONTH(tgl_pendapatan) BETWEEN '$bln' AND '$blnplus2'")->row();
		$cpnd = $sqlcekpnj->tgl;
		if($cpnd < 3){
			echo '<br>ada';
				$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Oppss</h4>
                    <p>Data pendapatan belum tersedia untuk perhitungan pada periode ini.</p>
                </div>'); 
		}else{


		//$jmlsqlcekpnj1 = sizeof($sqlcekpnj1);
		$sqlcek1 = $this->db->query("SELECT count(id_peramalan_winter) as ttl FROM tbl_peramalan_winter WHERE DATE_FORMAT(tgl_peramalan_winter, '%Y') = '$thn' AND MONTH(tgl_peramalan_winter) BETWEEN '$bln' AND '$blnplus2'")->row();
		$jmlsqlcek1 = $sqlcek1->ttl;

		if($jmlsqlcek1 > 0){
			echo '<br>ada';
				$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Oppss</h4>
                    <p>Peramalan periode ini sudah dibuat.</p>
                </div>'); 
		}else{
			echo '<br>tidak ada';
			$sqldtpn1 = $this->db->query("SELECT SUM(jumlah_pendapatan) as total FROM tbl_pendapatan WHERE DATE_FORMAT(tgl_pendapatan, '%Y') = '$thn' AND MONTH(tgl_pendapatan) BETWEEN '$bln' AND '$blnplus2'")->row();
				echo '<br>'.$Ft1 = $sqldtpn1->total;

			$sqldtpn11 = $this->db->query("SELECT SUM(jumlah_pendapatan) as total FROM tbl_pendapatan WHERE DATE_FORMAT(tgl_pendapatan, '%Y') = '$thn' AND MONTH(tgl_pendapatan) = '$bln'")->row();
				echo '<br>'.$Ft11 = $sqldtpn11->total;
				
				echo '<br>'.$sl = $Ft1/$cpnd;
				echo '<br>'.$bl = $sl/$cpnd;
				echo '<br>'.$ll = $Ft11/$sl;

				for($a = 0; $a < 3; $a++){
				echo 'Bulan'.$bln;
				$sqldtpnbln = $this->db->query("SELECT SUM(jumlah_pendapatan) as total FROM tbl_pendapatan WHERE MONTH(tgl_pendapatan) = '$bln' AND YEAR(tgl_pendapatan) = '$thn'")->row();
				echo '<br>'.$pndbln = $sqldtpnbln->total;
				
					echo '<br>'.$gtw = $pndbln / $sl;
					echo '<br>'.$st = $alp*($pndbln/$gtw)+$alpmin*($sl+$bl);
					echo '<br>'.$bt = $alp*($sl-$st)+($alpmin*$bl);
					echo '<br>'.$lt = $alp*($pndbln/$sl)+($alpmin*$gtw);
					echo '<br>'.$ftm = ($st+$bt)*$lt;
					echo '<br>'.$rmse = sqrt((pow(($pndbln-$ftm),2)/3));
					echo '<br>';
					echo '<br>';

					if($bln < 10){
						$blnn = '0'.$bln;
					}else{
						$blnn = $bln;
					}
					
					$data = array(
					'id_peramalan_winter' => '', 
					'tgl_peramalan_winter' => $thn.'-'.$blnn.'-01',
					'alpha_winter' => $alp,
					'abg_winter' => $alp.','.$alp.','.$alp,
					'st_winter' => $st,
					'bt_winter' => $bt,
					'lt_winter' => $lt,
					'ftm_winter' => $ftm,
					'rmse_winter' => $rmse
					);
				$this->m_data->input_data($data, 'tbl_peramalan_winter');
				$bln++;}

				
			
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-success">
                    <h4>Yeayy</h4>
                    <p>Peramalan periode ini berhasil dibuat.</p>
                </div>'); 
		}
		}
	redirect('Admin/Peramalan_winter/index');
	}

	public function hapus($id_prm){
		$where = array('id_peramalan_winter' => $id_prm);
		$this->m_data->del_data($where, 'tbl_peramalan_winter');
		$this->session->set_flashdata('msg', 
                '<div class="alert alert-success">
                    <h4>Yeayy</h4>
                    <p>Peramalan periode ini berhasil dihapus.</p>
                </div>'); 
		redirect('Admin/Peramalan_winter/index');
	}		
}
