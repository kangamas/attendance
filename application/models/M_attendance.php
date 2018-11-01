<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_attendance extends CI_Model {

	function input_attendance_1($data){
		return $this->db->insert('ie_attendance_1', $data);
	}
	function input_attendance_2($data){
		return $this->db->insert('ie_attendance_2', $data);
	}
	function input_attendance_3($data){
		return $this->db->insert('ie_attendance_3', $data);
	}
	function list_attendance_1(){
		$this->db->order_by('create_date', 'desc');
		return $this->db->get('ie_attendance_1')->result();
	}
	function update_attendance_1($id,$data){
		$this->db->where('member_id', $id);
		return $this->db->update('ie_attendance_1', $data);
	}

}

/* End of file M_attendance.php */
/* Location: ./application/models/M_attendance.php */