<?php
	class model_login extends CI_Model {
		function login ($username, $password){
			//$this->db->get_where('user',array('username'=>$username,'password'=> md5($password)));
			$this->db->select('*');
			$this->db->from('pengguna');
			$this->db->where('username_pengguna', $username);
			$this->db->where('password_pengguna', $password);
			return $this->db->get();
		}

		function tampilData(){
			return $this->db->get('user');
		}
	}
?>