<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ayam_brewok extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Pendapatan Ayam Brewok',
            'navigation' => 'navigation/nav',
            'content' => 'admin/ab'
        ];
        $this->load->view('template/content', $data);
    }

    public function detail_rekap_bulanan()
    {
        $data = [
            'title' => 'Detail Pendapatan',
            'content' => 'admin/detail_ab',
            'navigation' => 'navigation/nav'
        ];
        $this->load->view('template/content', $data);
    }
}
