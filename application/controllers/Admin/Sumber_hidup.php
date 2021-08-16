<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sumber_hidup extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Pendapatan Sumber Hidup',
            'navigation' => 'navigation/nav',
            'content' => 'admin/sh'
        ];
        $this->load->view('template/content', $data);
    }

    public function detail_rekap_bulanan()
    {
        $data = [
            'title' => 'Detail Pendapatan',
            'content' => 'admin/detail_sh',
            'navigation' => 'navigation/nav'
        ];
        $this->load->view('template/content', $data);
    }
}
