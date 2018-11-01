<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_registrasi');
		$this->load->model('m_attendance'); 
	}

	public function index()
	{
		$this->load->view('form-registrasi');
	}
	function add(){
		if (isset($_POST['btnregis'])) {
			$id = html_escape($this->input->post('inputnoanggota'));
			$cek = $this->m_registrasi->cekreg($id);
			if ($cek < 1) {
				//qrcode
				$this->load->library('ciqrcode'); //pemanggilan library QR CODE

				$config['cacheable']	= true; //boolean, the default is true
				$config['cachedir']		= './assets/'; //string, the default is application/cache/
				$config['errorlog']		= './assets/'; //string, the default is application/logs/
				$config['imagedir']		= './assets/images/'; //direktori penyimpanan qr code
				$config['quality']		= true; //boolean, the default is true
				$config['size']			= '1024'; //interger, the default is 1024
				$config['black']		= array(224,255,255); // array, default is array(255,255,255)
				$config['white']		= array(70,130,180); // array, default is array(0,0,0)
				$this->ciqrcode->initialize($config);

				$image_name=html_escape($this->input->post('inputnoanggota')).'.png'; //buat name dari qr code sesuai dengan nim

				$params['data'] = html_escape($this->input->post('inputnoanggota')); //data yang akan di jadikan QR CODE
				$params['level'] = 'H'; //H=High
				$params['size'] = 10;
				$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
				$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
				// ------------------------------
				//foto member

				$config['upload_path'] = './assets/images/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']  = '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				$config['file_name'] = "foto-".html_escape($this->input->post('inputnoanggota'));

				$this->load->library('upload',$config);
				// $this->upload->initialize($config);
				$this->upload->do_upload('inputfoto');
				$foto_name = $this->upload->data();
				// ------------------------------
				$data = array(
					'member_id' => html_escape($this->input->post('inputnoanggota')),
					'member_name' => html_escape($this->input->post('inputfullname')),
					'member_ktp' => html_escape($this->input->post('inputktp')),
					'member_birthplace' => html_escape($this->input->post('inputtmplahir')),
					'member_birthdate' => html_escape($this->input->post('inputtgllahir')),
					'member_officeaddress' => html_escape($this->input->post('inputalmtkantor')),
					'member_officetlp' => html_escape($this->input->post('inputtlpkantor')),
					'member_officefax' => html_escape($this->input->post('inputfaxkantor')),
					'member_phone' => html_escape($this->input->post('inputhp')),
					'member_email' => html_escape($this->input->post('inputemail')),
					'member_photo' => $foto_name['file_name'],
					'member_workregion' => html_escape($this->input->post('inputwk')), 
					'member_qrcode' => $image_name, 
				);
				$data2 = array(
					'member_id' => html_escape($this->input->post('inputnoanggota')),
					'member_name' => html_escape($this->input->post('inputfullname')),
				);
				$add = $this->m_registrasi->input($data);
				if ($add) {
					$this->m_attendance->input_attendance_1($data2);
					$this->m_attendance->input_attendance_2($data2);
					$this->m_attendance->input_attendance_3($data2);

					$this->session->set_flashdata('hasil','success');
					redirect('registrasi');
				}else{
					$this->session->set_flashdata('hasil','fail');
					redirect('registrasi');
				}
			}else{
				$this->session->set_flashdata('hasil','fail');
				redirect('registrasi');
			}
			
		}else{
			redirect('registrasi','refresh');
		}
	}

}

/* End of file Registrasi.php */
/* Location: ./application/controllers/Registrasi.php */