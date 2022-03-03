<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peramalan_winter2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $data['title'] = 'DES Holt-Winter';
        $data['navigation'] = 'navigation/nav';
        $data['content'] = 'admin/form_ramal_winter2';
        $data['user'] = $this->m_data->show_data('tbl_usaha')->result();
        // $data['user2']= $this->m_data->coba3()->result();
        //$data['user2']= $this->m_data->show_data('tbl_forecast')->result();
        // $data['user2'] = $this->db->query("
        // 	SELECT tf.tgl_peramalan_winter, tf.alpha_winter, tf.abg_winter, tf.st_winter, tf.bt_winter, tf.lt_winter, tf.ftm_winter, tf.rmse_winter, tf.id_peramalan_winter
        // 	FROM tbl_peramalan_winter tf 
        // 	")->result();
        $data['user2'] = $this->m_data->Show_data('tbl_peramalan_winter')->result();
        $this->load->view('template/content', $data);
    }

    public function hapus($id_prm)
    {
        $where = array('id_peramalan_winter' => $id_prm);
        $this->m_data->del_data($where, 'tbl_peramalan_winter');
        $this->session->set_flashdata(
            'msg',
            '<div class="alert alert-success">
                    <h4>Yeayy</h4>
                    <p>Peramalan periode ini berhasil dihapus.</p>
                </div>'
        );
        redirect('Admin/Peramalan_winter/index');
    }

    public function perhitungan2()
    {
        $bln = $this->input->post('bln');
        $thn = $this->input->post('thn');
        $alp = $this->input->post('alpha');
        $alp = $this->input->post('alpha');
        $beta = $this->input->post('beta');
        $gamma = $this->input->post('gamma');
        $date = $thn . '-' . $bln . '-01';
        if ($bln < 10) {
            $bln2 = '01-' . '0' . $bln . '-' . $thn;
        } else {
            $bln2 = '01-' . $bln . '-' . $thn;
        }
        echo '<br>Bln 1 = ' . $bln;
        echo '<br>Bln 2 = ' . $blnplus1 = date('m', strtotime("+1 month", strtotime($bln2)));
        echo '<br>Bln 3 = ' . $blnplus2 = date('m', strtotime("+12 month", strtotime($bln2)));
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
        $sqlcek2 = $this->db->query("SELECT * FROM tbl_peramalan_winter WHERE DATE_FORMAT(tgl_peramalan_winter, '%Y-%m') = '$blnp'")->row();
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

            $sqldtpn1 = $this->db->query("SELECT tgl_pendapatan, SUM(jumlah_pendapatan) as total FROM tbl_pendapatan WHERE DATE_FORMAT(tgl_pendapatan, '%Y') = '$thn' AND MONTH(tgl_pendapatan) = '$bln'")->row();
            echo '<br>Ft 1 = ' . $Ft1 = $sqldtpn1->total;

            $sqldtpn11 = $this->db->query("SELECT SUM(jumlah_pendapatan) as total FROM tbl_pendapatan WHERE DATE_FORMAT(tgl_pendapatan, '%Y') = '$thn' AND MONTH(tgl_pendapatan) = '$bln'")->row();
            echo '<br>FT 11 = ' . $Ft11 = $sqldtpn11->total;
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
            $betamin = 1 - $beta;
            $gammamin = 1 - $gamma;

            echo '<br>sl = ' . $sl = $Ft1 / 12;
            echo '<br>bl = ' . $bl = $sl / 12;
            echo '<br>il = ' . $il = $bln_sblm / $sl;

            $sqldtpnbln = $this->db->query("SELECT SUM(jumlah_pendapatan) as total FROM tbl_pendapatan WHERE MONTH(tgl_pendapatan) = '$bln' AND YEAR(tgl_pendapatan) = '$thn'")->row();
            echo '<br>pndbln = ' . $pndbln = $sqldtpnbln->total;

            echo '<br>st = ' . $st = $alp * ($pndbln / $il) + $alpmin * ($sl + $bl);
            echo '<br>bt = ' . $bt = $beta * ($sl - $st) + ($betamin * $bl);
            echo '<br>lt = ' . $lt = $gamma * ($pndbln / $sl) + ($gammamin * $il);
            echo '<br>ftm = ' . $ftm = ($st + $bt) * $lt;
            echo '<br>rmse2 = ' . $rmse = sqrt(pow(($pndbln - $ftm), 2)) / 12;
            $x = $Ft - $ftm;
            $y = $x / $Ft;
            $z = $y * 100;
            $q = $z / 12;
            echo '<br> MAPE = ' . $q;
            echo '<br>';
            echo '<br>';
            // die(var_dump($q));

            $data = array(
                'id_peramalan_winter    ' => '',
                'tgl_peramalan_winter' => $blnp . '-01',
                'alpha_winter' => $alp,
                'beta' => $beta,
                'gamma' => $gamma,
                'data_aktual_winter' => $Ft,
                'st_winter' => $st,
                'bt_winter' => $bt,
                'lt_winter' => $lt,
                'ftm_winter' => $ftm,
                'rmse_winter' => $rmse,
                'abg_winter' => $alp . ',' . $alp . ',' . $alp,
            );
            $this->m_data->input_data($data, 'tbl_peramalan_winter');
            $this->session->set_flashdata(
                'msg',
                '<div class="alert alert-success">
                    <h4>Yeayy</h4>
                    <p>Peramalan periode ini berhasil dibuat.</p>
                </div>'
            );
        }
        redirect('Admin/Peramalan_winter2/index');
    }
}
