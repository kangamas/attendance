<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_attendance'); 
	}

	public function index()
	{
		$this->load->view('daftar-hadir-1');
	}
	function attendance_1(){
		$data = $this->m_attendance->list_attendance_1();
		echo json_encode($data);
	}
	function update_attendance_1(){
		$member_id = $this->input->post('member_id');
		$value = array(
			'date_entry' => date('Y-m-d'),
			'time_entry' => date("H:i:s"),
			'status' => "Hadir",
		);
		$data = $this->m_attendance->update_attendance_1($member_id,$value);
		echo json_encode($data);
	}
	function votein(){
		
	}

}

/* End of file Attendance.php */
/* Location: ./application/controllers/Attendance.php */