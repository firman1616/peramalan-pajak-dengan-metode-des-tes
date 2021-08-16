<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_model
{

	public function Show_data($table)
	{
		return $this->db->get($table);
	}
	public function Show_data_join($table)
	{
		return $this->db->get($table);
	}
	public function coba()
	{
		$query = $this->db->query("SELECT * FROM tbl_penjualan1 where periode = '2015*01'");
		return $query;
	}
	public function coba2()
	{
		$query = $this->db->query("SELECT * FROM tbl_penjualan1 where periode != '2015*01'");
		return $query;
	}
	public function input_data($data, $table)
	{
		$this->db->insert($table, $data);
	}
	public function edit_data($where, $table)
	{
		$this->db->where($where);
		$query = $this->db->get($table);
		return $query;
	}
	public function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	public function del_data($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
	public function getCountForecast()
	{
		$query = $this->db->query("SELECT * FROM tbl_forecast");
		return $query->num_rows();
	}
	public function coba3()
	{
		$query = $this->db->query("SELECT * FROM tbl_forecast order by id desc LIMIT 6");
		return $query;
	}
	public function f1()
	{
		$query = $this->db->query("SELECT * FROM tbl_forecast order by id desc where alpha = '1'");
		return $query;
	}

	public function data_usaha()
	{
		return $this->db->query("SELECT * FROM tbl_usaha")->num_rows();
	}
}
