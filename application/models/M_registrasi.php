<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_registrasi extends CI_Model {

	function cekreg($id){
		$this->db->where('member_id', $id);
		return $this->db->get('ie_member')->num_rows();
	}
	function input($data){
		return $this->db->insert('ie_member', $data);
	}
	

}

/* End of file M_registrasi.php */
/* Location: ./application/models/M_registrasi.php */