<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Amanis extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Pendapatan Amanis',
            'navigation' => 'navigation/nav',
            'content' => 'admin/am'
        ];
        $this->load->view('template/content', $data);
    }

    public function detail_rekap_bulanan()
    {
        $data = [
            'title' => 'Detail Pendapatan',
            'content' => 'admin/detail_am',
            'navigation' => 'navigation/nav'
        ];
        $this->load->view('template/content', $data);
    }
}
