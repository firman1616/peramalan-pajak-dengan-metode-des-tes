<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function index()
    {
        $bulan = $this->input->post('bulan');
        $year = $this->input->post('tahun');
        $data = [
            'navigation' => 'navigation/nav',
            'title'      => 'Laporan Peramalan',
            'content'    => 'admin/laporan',
            'brown'      => $this->m_data->Show_data('tbl_peramalan')->result(),
            'winter'     => $this->m_data->Show_data('tbl_peramalan_winter')->result(),
            'fbrown'     => $this->m_data->filter_brown($bulan, $year),
            'fwinter'    => $this->m_data->filter_winter($bulan, $year)
        ];
        $this->load->view('template/content', $data);
    }
}
