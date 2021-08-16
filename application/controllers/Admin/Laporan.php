<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function index()
    {
        $data = [
            'navigation' => 'navigation/nav',
            'title'      => 'Laporan Peramalan',
            'content'    => 'admin/laporan',
            'brown'      => $this->m_data->Show_data('tbl_peramalan')->result(),
            'winter'     => $this->m_data->Show_data('tbl_peramalan_winter')->result()
        ];
        $this->load->view('template/content', $data);
    }
}
